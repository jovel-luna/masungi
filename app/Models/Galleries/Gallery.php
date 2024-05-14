<?php

namespace App\Models\Galleries;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\Galleries\Gallery;
use App\Models\Files\File;
use App\Models\Picture;

use Carbon\Carbon;

class Gallery extends Model
{

    const TYPE_LANDSCAPE = 'LANDSCAPE';
    const TYPE_PEOPLE = 'PEOPLE';
    const TYPE_WILDLIFE = 'WILDLIFE';
    const TYPE_MOMENTS = 'MOMENTS';    

    protected $table = 'galleries';


    use FileTrait, ManyImagesTrait;

	/*
	 * Relationships
	 */

	public function files()
	{
	    return $this->morphMany(File::class, 'fileable');
	}

	public function pictures()
	{
	    return $this->morphMany(Picture::class, 'parent');
	}


    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['category','name', 'description'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'galleries-images');
        }


        if ($request->hasFile('images')) {
            $item->addImages($request->file('images'));
        }

        return $item;
    }

    /**
     * @Getters
     */
    public static function getTypes() {
        return [
            ['value' => static::TYPE_LANDSCAPE, 'label' => 'LANDSCAPE', 'class' => 'bg-success'],
            ['value' => static::TYPE_PEOPLE, 'label' => 'PEOPLE', 'class' => 'bg-warning'],
            ['value' => static::TYPE_WILDLIFE, 'label' => 'WILDLIFE', 'class' => 'bg-danger'],
            ['value' => static::TYPE_MOMENTS, 'label' => 'MOMENTS', 'class' => 'bg-info'],

        ];
    }


    public static function formatItem($item) {
        return [
            'name' => $item->name,
            'description' => $item->renderImagePath('description'),
            'image_path' => $item->renderImagePath('image_path'),
        ];
    }


    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        return route($prefix . '.galleries.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.galleries.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.galleries.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.galleries.remove-image', $this->id);
    }

}
