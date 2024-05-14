<?php

namespace App\Models\BlockedDateAndTime;

use App\Extenders\Models\BaseModel as Model;

use App\Models\TimeSlots\TimeSlot;
use App\Models\Trails\Trail;

class BlockedDateTime extends Model
{
	/*
	 * Relationship
	 */
	
    public function timeSlots()
    {
    	return $this->belongsToMany(TimeSlot::class, 'blocked_time_slot', 'blocked_date_time_id', 'time_slot_id')->withTrashed();
    }

    public function trail()
    {
    	return $this->belongsTo(Trail::class)->withTrashed();
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['trail_id', 'reason', 'description', 'date'])
    {
        $vars = $request->only($columns);
        $vars['is_whole_day'] = $request->is_whole_day == 'on' ? true : false;

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

        return route($prefix . '.blocked-dates.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.blocked-dates.archive', $this->id);
    }


    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.blocked-dates.restore', $this->id);
    }
}
