<?php

namespace App\Http\Controllers\Admin\EventInformations;

use App\Extenders\Controllers\FetchController;

use App\Models\EventInformations\EventInformation;

use App\Models\EventTypes\EventType;

use Carsbon\Carbon;

class EventInformationFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new EventInformation;
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
            'name' => $item->name,            
            'activity' => $item->activity,            
            'description' => $item->description,
            'features' => $item->features,
            'conservation_fees' => $item->conservation_fees,
            'image_path' => $item->renderImagePath(),
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchView($id = null) {
        $item = null;
        $types = EventInformation::getTypes();        
        $image_path = [];


        if ($id) {
            $item = EventInformation::withTrashed()->findOrFail($id);
            $item->removeImageUrl = $item->renderRemoveImageUrl();
            $item->name = $item->name;
            $item->path = $item->renderImagePath();
            
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

        return response()->json([
            'item' => $item,
            'image_path' => $image_path,
            'types' => $types,

        ]);
    }    
}
