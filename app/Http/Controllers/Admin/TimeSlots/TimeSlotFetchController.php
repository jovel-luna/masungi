<?php

namespace App\Http\Controllers\Admin\TimeSlots;

use Illuminate\Http\Request;
use App\Extenders\Controllers\FetchController;

use App\Models\TimeSlots\TimeSlot;
use App\Models\Trails\TrailType;
use App\Models\Trails\Trail;

use Carbon\Carbon;

class TimeSlotFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new TimeSlot;
    }


    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query)
    {
        $this->per_page = 100;
        $this->orderBy = 'order';
    	if ($this->request->filled('trail')) {
            $query = $query->where('trail_id', $this->request->input('trail'));
        }
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
            'type' => $item->type->name,
            'trail_id' => $item->trail_id,
            'day_week_name' => $item->day_week_name,
            'time' => $item->renderTime(),
            'order' => $item->order,
            'bg_color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchView($id = null) {
        $item = null;

        $types = TrailType::all();
        $trails = Trail::all();
        $days[0]['label'] = 'Weekday';
        $days[0]['value'] = 'Weekdays';
        $days[1]['label'] = 'Weekend & Holiday';
        $days[1]['value'] = 'Weekend & Holidays';

        if ($id) {
        	$item = TimeSlot::withTrashed()->findOrFail($id);
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
    		'item' => $item,
    		'types' => $types,
            'days' => $days,
            'trails' => $trails,
    	]);
    }
}
