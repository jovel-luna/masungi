<?php

namespace App\Models\OldNewCarousels;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\OldNewCarousels\OldNewCarousel;
use App\Models\Files\File;
use App\Models\Picture;

use Carbon\Carbon;

class OldNewCarousel extends Model
{
 

    use FileTrait, ManyImagesTrait;
    protected $table = 'oldnew_carousel';

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

        if ($request->hasFile('new_image_path')) {
            $item->storeImage($request->file('new_image_path'), 'new_image_path', 'newcarousels-images');
        }


        if ($request->hasFile('old_image_path')) {
            $item->storeImage($request->file('old_image_path'), 'old_image_path', 'oldcarousels-images');
        }


        return $item;
    }


        public static function formatItem($item) {
        return [
            'name' => $item->name,
            'new_image_path' => $item->renderImagePath('new_image_path'),
            'old_image_path' => $item->renderImagePath('old_image_path'),
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

        return route($prefix . '.oldnewcarousels.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.oldnewcarousels.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.oldnewcarousels.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.oldnewcarousels.remove-image', $this->id);
    }

    public function renderRequestVisitUrl() {
        return route('web.request-to-visit', [$this->id, $this->name]);
    }

}
