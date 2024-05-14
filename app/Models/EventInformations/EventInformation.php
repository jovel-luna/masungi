<?php

namespace App\Models\EventInformations;

use App\Extenders\Models\BaseModel as Model;

use App\Models\EventTypes\EventType;
use App\Models\EventInformations\EventInformation;


use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\Files\File;
use App\Models\Picture;


class EventInformation extends Model
{
    const TYPE_TEAMBUILDING = 'TEAM BUILDING';
    const TYPE_NUTUREAGROVEPROJECT = 'NUTURE A GROVEPROJECT';

    use FileTrait, ManyImagesTrait;

    protected $table = 'event_informations';


    public function eventtype()
    {
        return $this->belongsTo(EventType::class)->withTrashed();
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
    public static function store($request, $item = null, $columns = ['name', 'activity', 'description','features','conservation_fees'])
    {

        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'eventinformation-images');
        }

        return $item;
    
    }
   
    /**
     * @Getters
    */
    public static function getTypes() {
        return [
            ['value' => static::TYPE_TEAMBUILDING, 'label' => 'TEAMBUILDING', 'class' => 'bg-success'],
            ['value' => static::TYPE_NUTUREAGROVEPROJECT, 'label' => 'NUTUREAGROVEPROJECT', 'class' => 'bg-warning'],
           
        ];
    }


    public static function formatItem($item) {
        return [

            'name' => $item->name,
            'activity' => $item->activity,
            'description' => $item->description,
            'features' => $item->features,
            'conservation_fees' => $item->conservation_fees,
            'image_path' => $item->renderImagePath(),
     
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

        return route($prefix . '.eventinformations.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.eventinformations.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.eventinformations.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.eventinformations.remove-image', $this->id);
    }

    public function renderRequestVisitUrl() {
        return route('web.request-to-visit', [$this->id, $this->name]);
    }
    
    public function renderEventType() {
        return $this->eventtype->name;
    }

}
