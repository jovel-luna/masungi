<?php

namespace App\Http\Controllers\Admin\Eventpdfs;

use App\Extenders\Controllers\FetchController;
use App\Models\Events\Event;
use App\Models\Eventpdfs\Eventpdf;

class EventpdfFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Eventpdf;
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
                'document_path' => $item->renderFilePath(),
                'created_at' => $item->renderDate(),
                'deleted_at' => $item->deleted_at,
            ]);

            array_push($result, $data);
        }

        return $result;
    }

    /**
     * Build array date_add()
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
        $events = Event::all();

        if ($id) {
            $item = Eventpdf::withTrashed()->findOrFail($id);
            $item->path = $item->renderImagePath();
            $item->document_path_url = url($item->renderFilePath());
            $item = $this->formatView($item);
        }

        return response()->json([
            'item' => $item,
            'events' => $events,

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
