<?php

namespace App\Models\Awards;

use App\Extenders\Models\BaseModel as Model;

use App\Traits\FileTrait;

class Award extends Model
{
    use FileTrait;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['title', 'descripton'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'award');
        }

        if ($request->hasFile('images')) {
            $item->addImages($request->file('images'));
        }
        

        return $item;
    }

    /**
     * @Render
     */
    
    public static function formatItem($item) {
        return [
            'title' => $item->title,
            'description' => $item->description,
            'image_path' => $item->renderImagePath('image_path'),
        ];
    }    
    
    public function renderName() {
        return $this->name;
    }

    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.awards.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.awards.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.awards.restore', $this->id);
    }

        public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.awards.remove-image', $this->id);
    }
}
