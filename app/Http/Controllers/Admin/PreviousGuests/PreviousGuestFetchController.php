<?php

namespace App\Http\Controllers\Admin\PreviousGuests;

use App\Extenders\Controllers\FetchController;

use App\Models\Events\Event;

use App\Models\PreviousGuests\PreviousGuest;

class PreviousGuestFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new PreviousGuest;
    }

    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query)
    {
        /**
         * Queries
         * 
         */

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
            $data = array_merge($data, [
                'id' => $item->id,
                'event_id' => $item->renderEvent(),            
                'name' => $item->name,
                'image_path' => $item->renderImagePath(),
                'created_at' => $item->renderDate(),
                'deleted_at' => $item->deleted_at,
            ]);

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
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
        ];

    }

    public function fetchView($id = null)
    {
        $item = null;
        $images = [];
        $events = Event::all();        
        $types = PreviousGuest::getTypes();

        if ($id) {
            $item = PreviousGuest::withTrashed()->findOrFail($id);
            $item->name = $item->name;
            $item->path = $item->renderImagePath();
            $item = $this->formatView($item);
        }

        return response()->json([
            'item' => $item,
            'images' => $images,
            'events' => $events,            
            'types' => $types,
        ]);
    }

    protected function formatView($item)
    {
        $item->archiveUrl = $item->renderArchiveUrl();
        $item->restoreUrl = $item->renderRestoreUrl();
        $item->removeImageUrl = $item->renderRemoveImageUrl();

        return $item;
    }
}
