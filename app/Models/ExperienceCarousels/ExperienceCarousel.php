<?php

namespace App\Models\ExperienceCarousels;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\ExperienceCarousels\ExperienceCarousel;


use App\Models\Files\File;
use App\Models\Picture;

use Carbon\Carbon;

class ExperienceCarousel extends Model
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
    public static function store($request, $item = null, $columns = ['name','description'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'experiencecarousels-images');
        }

        return $item;
    }

    public static function formatItem($item) {
        return [
            'name' => $item->name,
            'description' => $item->description,
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

        return route($prefix . '.experiencecarousels.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.experiencecarousels.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.experiencecarousels.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.experiencecarousels.remove-image', $this->id);
    }

    public function renderRequestVisitUrl() {
        return route('web.request-to-visit', [$this->id, $this->name]);
    }
    
}
