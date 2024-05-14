<?php

namespace App\Models\TimeSlots;

use App\Extenders\Models\BaseModel as Model;

use App\Models\Trails\Trail;
use App\Models\Trails\TrailType;
use App\Models\BlockedDateAndTime\BlockedDateTime;

use Carbon\Carbon;

class TimeSlot extends Model
{

    protected $appends = ['formatted_time', 'formatted_time_with_indicator'];
    /*
     * Relationship
     */

    public function type()
    {
    	return $this->belongsTo(TrailType::class, 'trail_type_id', 'id');
    }

    public function trail()
    {
    	return $this->belongsTo(Trail::class);
    }

    public function blocks()
    {
        return $this->belongsToMany(BlockedDateTime::class, 'blocked_time_slot');
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['time', 'day_week_name', 'trail_type_id', 'trail_id'])
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
            $route = [$this->id];
        }

        return route($prefix . '.time-slots.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.time-slots.archive', $this->id);
    }


    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.time-slots.restore', $this->id);
    }

    public function renderTime() {
        $time = Carbon::parse($this->time)->format('h:i A');

        return $time;
    }

    /**
     * Appends formatted time
     *
     * @return string
     */
    public function getFormattedTimeAttribute()
    {
        return $this->renderTime();
    }

    /**
     * Appends formatted time
     *
     * @return string
     */
    public function getFormattedTimeWithIndicatorAttribute()
    {
        return "{$this->renderTime()} - {$this->day_week_name}";
    }
}
