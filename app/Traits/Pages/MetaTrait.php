<?php

namespace App\Traits\Pages;

use App\Http\Requests\Admin\Meta\MetaStoreRequest;
use App\Models\Pages\MetaTag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait MetaTrait
{
    /* Relationship */
    public function meta() {
        return $this->morphOne(MetaTag::class, 'page');
    }

    /* Get Meta Tag */
    public function getMeta() {
    	$item = $this->meta;
    	$result = null;

    	if ($item) {
    		$result = [
	    		'title' => $item->title,
	    		'description' => $item->description,
	    		'keywords' => $item->keywords,
	    		'og_title' => $item->og_title,
	    		'og_description' => $item->og_description,
	    		'path' => $item->renderImagePath(),
	    	];
    	}

    	return $result;
    }

    /* Store Meta Tags */
    public function storeMeta($request) {
    	$vars = [
    		'title' => $request->input('meta_title'),
    		'description' => $request->input('meta_description'),
    		'keywords' => $request->input('meta_keywords'),
    		'og_title' => $request->input('meta_og_title'),
    		'og_description' => $request->input('meta_og_description'),
    	];

        $validator = Validator::make($request->all(), [
            'meta_description' => 'max:150',
            'meta_title' => 'max:150',
            'meta_og_title' => 'max:50',
            'meta_og_description' => 'max:50',
        ]);

        if($validator->fails()) {
            throw ValidationException::withMessages([
                $validator->errors()->all()
            ]);
        }

    	$item = $this->meta;

    	if ($item) {
    		$item->update($vars);
            $message = 'Meta tags has been updated';
    	} else {
    		$item = $this->meta()->create($vars);
            $message = 'Meta tags has been created';
    	}

    	if ($request->hasFile('meta_og_image')) {
            $item->storeImage($request->file('meta_og_image'), 'image_path', 'meta-tags-images');
        }

        activity()
            ->causedBy($request->user())
            ->performedOn($this)
            ->log($message);

        return $item;
    }

    /* Render Meta Columns */
    public function renderMeta($column) {
        $result = null;

        if ($meta = $this->meta) {
            $result = $meta[$column];
        }

        return $result;
    }

    public function renderMetaImage() {
        $result = null;

        if ($meta = $this->meta) {
            $result = $meta->renderImagePath();
        }

        return $result;
    }
}