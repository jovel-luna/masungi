<?php

namespace App\Http\Controllers\Admin\ExperienceInformation;

use App\Extenders\Controllers\FetchController;

use App\Models\ExperienceInformations\ExperienceInformation;

use App\Models\Experiences\Experience;


use Carbon\Carbon;

class ExperienceInformationFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new ExperienceInformation;
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
            'duration' => $item->duration,
            'terrain' => $item->terrain,
            'age_group' => $item->age_group,
            'conservation_fees' => $item->conservation_fees,
            'overview' => $item->overview,
            'trail_characteristics' => $item->trail_characteristics,
            'ideal_for' => $item->ideal_for,
            'inclusions' => $item->inclusions,
            'good_to_know' => $item->good_to_know,
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchView($id = null) {
        $item = null;
        $experiences = Experience::all();
        $images = null;


        if ($id) {
        	$item = ExperienceInformation::withTrashed()->findOrFail($id);
	        $item->removeImageUrl = $item->renderRemoveImageUrl();
        	$item->name = $item->name;
        	$images = $item->getImages();
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
    		'item' => $item,
    		'images' => $images,
            'experiences' => $experiences,

    	]);
    }
}
