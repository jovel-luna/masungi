<?php

namespace App\Models\Eventpdfs;

use App\Extenders\Models\BaseModel as Model;
use App\Models\Events\Event;

use App\Traits\FileTrait;

class Eventpdf extends Model
{
    use FileTrait;

    public function event()
    {
        return $this->belongsTo(Event::class)->withTrashed();
    }


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
    public static function store($request, $item = null, $columns = ['event_id','name'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->hasFile('downloadable_path')) {
            $document_path = $request->file('downloadable_path')->store('Eventpdf-docs', 'public');
            $item->update([
                'document_path' => $document_path
            ]);
        }
        

        return $item;
    }

     public static function formatItem($item) {
        return [
            
            'event_id' => $item->event_id,
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

        return route($prefix . '.eventpdfs.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.eventpdfs.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.eventpdfs.restore', $this->id);
    }

        public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.eventpdfs.remove-image', $this->id);
    }

    public function renderEvent() {
        return $this->event->name;
    }

}
