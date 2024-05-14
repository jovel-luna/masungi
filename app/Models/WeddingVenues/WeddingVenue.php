<?php

namespace App\Models\WeddingVenues;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\Files\File;
use App\Models\Picture;
use App\Models\Venues\Venue;

use Carbon\Carbon;

class WeddingVenue extends Model
{

    const TYPE_SILAYAN = 'SILAYAN';
    const TYPE_PINEPATCH = 'PINEPATCH';

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

    public function venues()
    {
        return $this->belongsTo(Venue::class, 'category');
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
            $item->storeImage($request->file('image_path'), 'image_path', 'weddingvenues-images');
        }


        if ($request->hasFile('images')) {
            $item->addImages($request->file('images'));
        }

        return $item;
    }


    public static function formatItem($item) {
        return [
            'category' => $item->category,
            'name' => $item->name,
            'description' => $item->description,            
            'image_path' => $item->renderImagePath(),
        
        ];
    }


    /**
     * @Getters
     */
    public static function getTypes() {
        return [
            ['value' => static::TYPE_SILAYAN, 'label' => 'SILAYAN', 'class' => 'bg-success'],
            ['value' => static::TYPE_PINEPATCH, 'label' => 'PINEPATCH', 'class' => 'bg-warning'],
        ];
    }


    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        return route($prefix . '.weddingvenues.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.weddingvenues.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.weddingvenues.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.weddingvenues.remove-image', $this->id);
    }

}
