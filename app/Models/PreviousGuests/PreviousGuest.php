<?php

namespace App\Models\PreviousGuests;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\Files\File;
use App\Models\Picture;
use App\Models\Events\Event;

use Carbon\Carbon;

class PreviousGuest extends Model
{

    const TYPE_COMPANY = 'COMPANY';
    const TYPE_SCHOOL = 'SCHOOL';

    use FileTrait, ManyImagesTrait;
    

	/*
	 * Relationships
	 */
    
    public function event()
    {
        return $this->belongsTo(Event::class)->withTrashed();
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
    public static function store($request, $item = null, $columns = ['event_id', 'name'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'previousguests-images');
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
            ['value' => static::TYPE_SCHOOL, 'label' => 'SCHOOL', 'class' => 'bg-success'],
            ['value' => static::TYPE_COMPANY, 'label' => 'COMPANY', 'class' => 'bg-warning'],

        ];
    }

    public static function formatItem($item) {
        return [
            
            'name' => $item->name, 
            'image_path' => $item->renderImagePath(),
        ];
    }


    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        return route($prefix . '.previousguests.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.previousguests.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.previousguests.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.previousguests.remove-image', $this->id);
    }

    public function renderEvent() {
        return $this->event->name;
    }
    

}
