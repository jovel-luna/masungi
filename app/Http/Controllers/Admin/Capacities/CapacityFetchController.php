<?php

namespace App\Http\Controllers\Admin\Capacities;

use App\Extenders\Controllers\FetchController;

use App\Models\Capacities\Capacity;
use App\Models\Trails\Trail;

class CapacityFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Capacity;
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
            'trail' => $item->trail->name,
            'capacity' => $item->capacity,
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchView($id = null) {
        $item = null;
        $ids = Capacity::get()->pluck('allocation_id');
        $trails = Trail::with('experience')->whereNotIn('id', $ids)->get();

        if ($id) {
        	$item = Capacity::withTrashed()->findOrFail($id);
        	$trails = Trail::with('experience')->whereNotIn('id', $ids)->orWhere('id', $item->trail_id)->get();
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }


    	return response()->json([
    		'item' => $item,
    		'trails' => $trails,
    	]);
    }
}
