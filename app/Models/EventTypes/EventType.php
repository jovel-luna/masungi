<?php
namespace App\Models\EventTypes;

use App\Extenders\Models\BaseModel as Model;

use App\Models\EventCarousels\EventCarousel;
use App\Models\EventInformations\EventInformation;
use App\Models\EventTypes\EventType;
use App\Models\Events\Event;


use App\Traits\FileTrait;

class EventType extends Model
{
    const TYPE_TEAMBUILDING = 'TEAM BUILDING';
    const TYPE_NUTUREAGROVEPROJECT = 'NUTURE A GROVEPROJECT';
    const TYPE_DISCOVERYTRAIL = 'DISCOVERY TRAIL';
    const TYPE_LEGACYTRAIL = 'LEGACY TRAIL';
    const TYPE_FAMILYTRAIL = 'FAMILY TRAIL';
    const TYPE_YOUNGEXPLORERSTRAIL = 'YOUNG EXPLORERS TRAIL';


    use FileTrait;
    
    public function event()
    {
    	return $this->belongsTo(Event::class)->withTrashed();
    }

    public function eventinformation()
    {
        return $this->hasMany(EventInformation::class)->withTrashed();
    }

    public function eventcarousel()
    {
        return $this->hasMany(EventCarousel::class, 'eventtype_id')->withTrashed();
    }
    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['event_id', 'name','activity', 'duration', 'age_group', 'participants', 'conservation_fees','conservation_info','features','description','status'])
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
     * @Getters
     */
    public static function getTypes() {
        return [
            ['value' => static::TYPE_TEAMBUILDING, 'label' => 'TEAMBUILDING', 'class' => 'bg-success'],
            ['value' => static::TYPE_NUTUREAGROVEPROJECT, 'label' => 'NUTUREAGROVEPROJECT', 'class' => 'bg-success'],
            ['value' => static::TYPE_DISCOVERYTRAIL, 'label' => 'DISCOVERYTRAIL', 'class' => 'bg-success'],
            ['value' => static::TYPE_LEGACYTRAIL, 'label' => 'LEGACYTRAIL', 'class' => 'bg-success'],            
            ['value' => static::TYPE_FAMILYTRAIL, 'label' => 'FAMILYTRAIL', 'class' => 'bg-success'],
            ['value' => static::TYPE_YOUNGEXPLORERSTRAIL, 'label' => 'YOUNGEXPLORERSTRAIL', 'class' => 'bg-success'],
           
        ];
    }


    public static function formatItem($item) {
        return [

            'name' => $item->name,
            'activity' => $item->activity,
            'duration' => $item->duration,
            'age_group' => $item->age_group,
            'participants' => $item->participants,
            'conservation_fees' => $item->conservation_fees,     
            'conservation_info' => $item->conservation_info,     
            'features' => $item->features,                   
            'description' => $item->description,       
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

        return route($prefix . '.eventtypes.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.eventtypes.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.eventtypes.restore', $this->id);
    }


    public function renderEvent() {
        return $this->event->name;
    }

}
