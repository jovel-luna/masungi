<?php

namespace App\Http\Controllers\Admin\OldNewCarousels;

use App\Extenders\Controllers\FetchController;

use App\Models\OldNewCarousels\OldNewCarousel;

class OldNewCarouselFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new OldNewCarousel;
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
                'name' => $item->name,
                'old_image_path' => $item->renderImagePath('old_image_path'),
                'new_image_path' => $item->renderImagePath('new_image_path'),                
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
        $old_image_path = [];
        $new_image_path = [];

        if ($id) {
            $item = OldNewCarousel::withTrashed()->findOrFail($id);
            $item->new_image_path = $item->renderImagePath('new_image_path');
            $item->old_image_path = $item->renderImagePath('old_image_path');
            
            $item = $this->formatView($item);
        }

        return response()->json([
            'item' => $item,
            'old_image_path' => $old_image_path,
            'new_image_path' => $new_image_path,
        
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
