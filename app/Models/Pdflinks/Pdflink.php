<?php

namespace App\Models\Pdflinks;

use App\Extenders\Models\BaseModel as Model;

use App\Traits\FileTrait;

class Pdflink extends Model
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
    public static function store($request, $item = null, $columns = ['name'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->hasFile('downloadable_path')) {
            $document_path = $request->file('downloadable_path')->store('Pdflink-docs', 'public');
            $item->update([
                'document_path' => $document_path
            ]);
        }
        

        return $item;
    }

     public static function formatItem($item) {
        return [
            'name' => $item->name,
            'document_path' => $item->renderFilePath(),
            'created_at' => $item->renderDateNews(),
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

        return route($prefix . '.pdflinks.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.pdflinks.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.pdflinks.restore', $this->id);
    }

        public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.pdflinks.remove-image', $this->id);
    }
}
