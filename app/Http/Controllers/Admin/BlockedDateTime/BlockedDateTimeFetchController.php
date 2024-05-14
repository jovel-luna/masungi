<?php

namespace App\Http\Controllers\Admin\BlockedDateTime;

use Illuminate\Http\Request;
use App\Extenders\Controllers\FetchController;

use App\Models\BlockedDateAndTime\BlockedDateTime;
use App\Models\TimeSlots\TimeSlot;
use App\Models\Trails\Trail;

use Carbon\Carbon;

class BlockedDateTimeFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new BlockedDateTime;
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
            'reason' => $item->reason,
            'date' => Carbon::parse($item->date)->format('M d, Y'),
            'isWholeDayLabel' => $item->is_whole_day ? 'Whole Day' : 'Selected Time',
            'isWholeDayClass' => $item->is_whole_day ? 'bg-primary' : 'bg-warning',
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchView(Request $request) {
        $item = null;
        $time_datas = [];
        $trails = Trail::all();
        $first_trail = Trail::first();
        if($request->has('trail_id')) {
            $time_datas = TimeSlot::orderBy('order', 'DESC')->where('trail_id', $request->trail_id)->get();
        } else {
            $time_datas = TimeSlot::orderBy('order', 'DESC')->where('trail_id', $first_trail->id)->get();
        }

        if ($request->id) {
        	$item = BlockedDateTime::withTrashed()->findOrFail($request->id);
        	$item->slots = $item->timeSlots->pluck('id');
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
    		'item' => $item,
    		'time_datas' => $time_datas,
    		'trails' => $trails,
            'trail_id' => $request->trail_id
    	]);
    }
}
