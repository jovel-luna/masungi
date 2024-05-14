<?php

namespace App\Http\Controllers\Admin\EventTypes;

use App\Extenders\Controllers\FetchController;

use App\Models\Events\Event;

use App\Models\EventTypes\EventType;

use Carsbon\Carbon;

class EventTypeFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new EventType;
    }

    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query)
    {
        return $query;
    }

    /**
     * Custom formatting of data
     * 
     * @param Illuminate\Support\Collection $items
     * @return array $result
     */
    public function formatData($items)
    {
        $result = [];

        foreach($items as $item) {
            $data = $this->formatItem($item);
            array_push($result, $data);
        }

        return $result;
    }

    /**
     * Build array data
     * 
     * @param  App\Contracts\AvailablePosition
     * @return array
     */
    protected function formatItem($item)
    {
        return [
            'id' => $item->id,
            'event_id' => $item->renderEvent(),            
            'name' => $item->name,      
            'activity' => $item->activity,                  
            'duration' => $item->duration,
            'age_group' => $item->age_group,
            'participants' => $item->participants,
            'conservation_fees' => $item->conservation_fees,
            'conservation_info' => $item->conservation_info,  
            'features' => $item->features,                                         
            'description' => $item->description,            
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchView($id = null) {
        $item = null;
        $events = Event::all();
        $types = EventType::getTypes();        
        $image_path = null;


        if ($id) {
        	$item = EventType::withTrashed()->findOrFail($id);
        	$item->name = $item->name;
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
    		'item' => $item,
    		'image_path' => $image_path,
            'events' => $events,
            'types' => $types,

    	]);
    }
}
