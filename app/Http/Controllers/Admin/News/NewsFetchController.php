<?php

namespace App\Http\Controllers\Admin\News;

use App\Extenders\Controllers\FetchController;

use App\Models\News\News;

class NewsFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new News;
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
                'title' => $item->title,
                'description' => $item->description,
                'image_path' => $item->renderImagePath(),
                'link' => $item->link,
                'link_label' => $item->link_label,
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

        if ($id) {
            $item = News::withTrashed()->findOrFail($id);
            $item->path = $item->renderImagePath();

            $item = $this->formatView($item);
            $meta = $item->getMeta();
        }

        return response()->json([
            'item' => $item,
            'images' => $images,
            'meta' => $meta,
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
