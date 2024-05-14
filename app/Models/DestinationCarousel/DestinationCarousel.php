<?php

namespace App\Models\DestinationCarousel;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\Files\File;
use App\Models\Picture;

use Carbon\Carbon;

class DestinationCarousel extends Model
{

    const TYPE_ABOUTMASUNGI = 'ABOUT MASUNGI';
    const TYPE_THEAREA = 'THE AREA';

    protected $table = 'destination_carousel';


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
    public static function store($request, $item = null, $columns = ['name'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'destinationcarousel-images');
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
            ['value' => static::TYPE_ABOUTMASUNGI, 'label' => 'ABOUT MASUNGI', 'class' => 'bg-success'],
            ['value' => static::TYPE_THEAREA, 'label' => 'THE AREA', 'class' => 'bg-warning'],
        ];
    }

    public static function formatItem($item) {
        return [
            'name1' => $item->name,
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

        return route($prefix . '.destinationcarousel.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.destinationcarousel.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.destinationcarousel.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.destinationcarousel.remove-image', $this->id);
    }

    public function renderRequestVisitUrl() {
        return route('web.request-to-visit', [$this->id, $this->name]);
    }

}
