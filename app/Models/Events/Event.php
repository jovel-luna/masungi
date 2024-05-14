<?php

namespace App\Models\Events;

use App\Extenders\Models\BaseModel as Model;
use App\Models\Events\Event;
use App\Models\EventTypes\EventType;
use App\Models\Eventpdfs\Eventpdf;
use App\Models\PreviousGuests\PreviousGuest;

class Event extends Model
{

    public function previousguest()
    {
        return $this->hasMany(PreviousGuest::class);
    }

    public function eventtype()
    {
        return $this->hasMany(EventType::class);
    }

    public function eventpdf()
    {
        return $this->hasMany(Eventpdf::class);
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['name','description','status'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        return $item;
    }

    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.events.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.events.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.events.restore', $this->id);
    }

    public function renderEvent() {
        return $this->event->name;
    }


}
