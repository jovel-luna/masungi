<?php

namespace App\Http\Controllers\Admin\Trails;

use Illuminate\Http\Request;
use App\Extenders\Controllers\FetchController;

use App\Models\Trails\Trail;
use App\Models\Experiences\Experience;

use Carbon\Carbon;

class TrailFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Trail;
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
            'experience' => $item->renderExperience(),
            'name' => $item->name,
            'description' => $item->description,
            'weekday_fee' => $item->weekday_fee,
            'weekend_fee' => $item->weekend_fee,
            'fee_per_guest' => $item->fee_per_guest,
            'estimated_duration' => $item->estimated_duration,
            'recommended_for' => $item->recommended_for,
            'minimum_participant' => $item->minimum_participant,
            'paypal_charges' => $item->paypal_charges,
            'terrain' => $item->terrain,
            'age_group' => $item->age_group,
            'overview' => $item->overview,
            'characteristic' => $item->characteristic,
            'ideal_for' => $item->ideal_for,
            'inclusions' => $item->inclusions,
            'good_to_know' => $item->good_to_know,
            'visit_request_process' => $item->visit_request_process,
            'timeslots' => $item->timeslots()->count(),


            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'showTimeSlotsUrl' => $item->renderShowUrl('admin', true),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchView($id = null) {
        $item = null;
        $experiences = Experience::all();

        if ($id) {
        	$item = Trail::withTrashed()->findOrFail($id);
            $item->experience = $item->renderExperience();
            $item->name = $item->name;
            $item->showDates = $item->is_special_event ? true : false;
            $item->date_to_show = Carbon::parse($item->date_to_show)->format('Y-m-d H:i:s');
        	$item->expiration_date = Carbon::parse($item->expiration_date)->format('Y-m-d H:i:s');
            $item->path = $item->renderImagePath();
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
    		'item' => $item,
    		'experiences' => $experiences,
    	]);
    }
}
