<?php

namespace App\Models\BeyondMasungi;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\Files\File;
use App\Models\Picture;

use Carbon\Carbon;

class BeyondMasungi extends Model
{

    const TYPE_NATURE = 'NATURE';
    const TYPE_CULTURE = 'CULTURE';
    const TYPE_ARTS = 'ARTS';
    const TYPE_SEA = 'SEA';    

    use FileTrait, ManyImagesTrait;
    protected $table = 'beyond_masungi';

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
    public static function store($request, $item = null, $columns = ['title', 'description'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'beyondmasungi-images');
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
            ['value' => static::TYPE_NATURE, 'label' => 'NATURE', 'class' => 'bg-success'],
            ['value' => static::TYPE_CULTURE, 'label' => 'CULTURE', 'class' => 'bg-warning'],
            ['value' => static::TYPE_ARTS, 'label' => 'ARTS', 'class' => 'bg-danger'],
            ['value' => static::TYPE_SEA, 'label' => 'SEA', 'class' => 'bg-info'],

        ];
    }

    public static function formatItem($item) {
        return [
            'title' => $item->title,
            'description' => $item->description,
            'image_path' => $item->renderImagePath('image_path'),
        ];
    }

    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        return route($prefix . '.beyondmasungi.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.beyondmasungi.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.beyondmasungi.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.beyondmasungi.remove-image', $this->id);
    }

}
