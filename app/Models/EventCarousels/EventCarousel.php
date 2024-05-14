<?php

namespace App\Models\EventCarousels;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\EventTypes\EventType;
use App\Models\EventCarousels\EventCarousel;


use App\Models\Files\File;
use App\Models\Picture;

use Carbon\Carbon;

class EventCarousel extends Model
{
 
    use FileTrait, ManyImagesTrait;

    /*
     * Relationships
     */
    
    public function eventtype()
    {
        return $this->belongsTo(EventType::class);
    }    

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function pictures()
    {
        return $this->morphMany(Picture::class, 'parent');
    }
    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['eventtype_id','activity',])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'eventcarousels-images');
        }


        if ($request->hasFile('images')) {
            $item->addImages($request->file('images'));
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

        'eventtype_id' => $item->eventtype_id,   
        'activity' => $item->activity,
        'image_path' => $item->renderImagePath(),
        'created_at' => $item->renderDate(),
        'deleted_at' => $item->deleted_at,
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

        return route($prefix . '.eventcarousels.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.eventcarousels.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.eventcarousels.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.eventcarousels.remove-image', $this->id);
    }

    public function renderRequestVisitUrl() {
        return route('web.request-to-visit', [$this->id, $this->name]);
    }

    public function renderEventType() {
        return $this->eventtype ? $this->eventtype->name : '---';
    }


}
