<?php
namespace App\Models\Trails;

use App\Extenders\Models\BaseModel as Model;

use App\Models\Experiences\Experience;
use App\Models\TimeSlots\TimeSlot;
use App\Models\BlockedDateAndTime\BlockedDateTime;
use App\Models\TrailStops\TrailStop;
use App\Models\AddOns\AddOn;

use App\Traits\FileTrait;


use Carbon\Carbon;

class Trail extends Model
{

    use FileTrait;

    public function experience()
    {
    	return $this->belongsTo(Experience::class)->withTrashed();
    }

    // public function timeSlots()
    // {
    //     return $this->hasMany(TimeSlot::class);
    // }

    public function active_blocks()
    {
        return $this->hasMany(BlockedDateTime::class);
    }

    public function blocks()
    {
        return $this->hasMany(BlockedDateTime::class)->withTrashed();
    }

    public function timeslots()
    {
        return $this->hasMany(TimeSlot::class);
    }

    public function trailStops()
    {
        return $this->hasMany(TrailStop::class);
    }

    public function snacks()
    {
        return $this->belongsToMany(AddOn::class, 'addon_trails', 'trail_id', 'add_on_id');
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['experience_id', 'name', 'description', 'weekday_fee', 'weekend_fee', 'fee_per_guest', 'estimated_duration', 'recommended_for', 'minimum_participant', 'paypal_charges', 'terrain', 'age_group', 'overview', 'characteristic', 'ideal_for', 'inclusions', 'good_to_know', 'visit_request_process', 'terms_and_condition', 'expiration_date', 'date_to_show', 'cut_off', 'maximum_guest', 'capacity_per_day'])
    {
        $vars = $request->only($columns);
        $vars['is_special_event'] = $request->is_special_event ? 1: 0;
        $vars['has_snack'] = $request->has_snack ? 1: 0;

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'trails');
        }

        return $item;
    }

    /**
     * @Render
     */
    public function renderName() {
        return $this->name;
    }

    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin', $forTimeSlots = false) {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return $forTimeSlots ? route($prefix . '.trails.show-time-slots', $route) : route($prefix . '.trails.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.trails.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.trails.restore', $this->id);
    }


    public function renderExperience() {
        return $this->experience->name;
    }

    // public function getTimeSlots($type) {
    //     $data = [];
    //     $slots = [];

    //     switch ($type) {
    //         case 'day':
    //             $slots = $this->timeSlots->where('trail_type_id', 1);
    //             break;
    //         case 'night':
    //             $slots = $this->timeSlots->where('trail_type_id', 2);
    //             break;
    //         case 'dayNight':
    //             $slots = $this->timeSlots->where('trail_type_id', 3);
    //             break;

    //         default:
    //             # code...
    //             break;
    //     }


    //     foreach ($slots as $slot) {
    //         array_push($data, [
    //             'id' => $slot->id,
    //             'time' => $slot->time,
    //             'trail_type_name' => $slot->type->name,
    //             'formatted_time' => Carbon::parse($slot->time)->format('h:i A'),
    //             'date' => $slot->date,
    //             'is_block' => $slot->blocks->count() ? true : false,
    //         ]);
    //     }

    //     return $data;
    // }

    public function getBlockDate() {
        $data = [];

        foreach ($this->active_blocks as $block) {
            array_push($data, [
                'id' => $block->id,
                'date' => $block->date,
                'reason' => $block->reason,
                'is_whole_day' => $block->is_whole_day ? true : false,
            ]);
        }

        return $data;
    }

    public static function formatItem($item) {
        return [
            'name' => $item->name,
            'experience_id' => $item->renderExperience(),
            'description' => $item->description,
            'image_path' => $item->renderImagePath('image_path'),
        ];
    }
}
