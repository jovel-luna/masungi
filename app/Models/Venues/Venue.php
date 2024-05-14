<?php

namespace App\Models\Venues;

use App\Extenders\Models\BaseModel as Model;

use App\Models\WeddingVenues\WeddingVenue;

class Venue extends Model
{

    /*
     * Relationships
     */

    public function weddingVenues()
    {
        return $this->hasMany(WeddingVenue::class, 'category');
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

        return $item;
    }

    public static function formatItem($item) {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'weddingVenues' => $item->weddingVenues ?? [],
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
        return route($prefix . '.venues.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.venues.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.venues.restore', $this->id);
    }
}
