<?php

namespace App\Models\Features;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\Files\File;
use App\Models\Picture;

use Carbon\Carbon;

class Feature extends Model
{

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
    public static function store($request, $item = null, $columns = ['name', 'link'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'features-images');
        }


        if ($request->hasFile('images')) {
            $item->addImages($request->file('images'));
        }

        return $item;
    }

    public static function formatItem($item) {
        return [
            'name1' => $item->name,
            'link' => $item->link,            
            'image_path' => $item->renderImagePath('image_path'),
        ];
    }

    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.features.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.features.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.features.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.features.remove-image', $this->id);
    }
}
