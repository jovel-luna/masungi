<?php

namespace App\Models\Collaborators;

use App\Extenders\Models\BaseModel as Model;

use App\Traits\FileTrait;

class Collaborator extends Model
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
            'name' => $this->name,
        ];
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['name', 'description'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'collaborator-image');
        }

        if ($request->hasFile('images')) {
            $item->addImages($request->file('images'));
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
    
    public function renderName() {
        return $this->name;
    }

    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.collaborators.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.collaborators.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.collaborators.restore', $this->id);
    }

        public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.collaborators.remove-image', $this->id);
    }
}
