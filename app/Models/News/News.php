<?php

namespace App\Models\News;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;
use App\Traits\Pages\MetaTrait;

use App\Models\Files\File;
use App\Models\Picture;

use Carbon\Carbon;

class News extends Model
{

    use FileTrait, ManyImagesTrait, MetaTrait;

    protected $casts = [
        'published_date' => 'datetime:M d, Y',
    ];

	/*
	 * Relationships
	 */

	public function files()
	{
	    return $this->morphMany(File::class, 'fileable');
	}

	public function pictures()
	{
	    return $this->morphMany(Picture::class, 'parent');
	}
    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['title', 'description', 'published_date', 'link', 'link_label'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        $item->storeMeta($request);

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'news-images');
        }


        if ($request->hasFile('images')) {
            $item->addImages($request->file('images'));
        }

        return $item;
    }


    public static function formatItem($item) {
        return [
            'id' => $item->id,
            'news_id' => $item->id, 
            'title' => $item->title,
            'description' => $item->description,
            'link' => $item->link,
            'link_label' => $item->link_label,     
            'showUrl' => $item->renderShowUrl('web'),     
            'image_path' => $item->renderImagePath('image_path'),
            'published_date' => $item->renderDateNews('published_date'),
            'created_at' => $item->renderDateNews(),
        ];
    }


    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            return route($prefix . '.news-view', $route);
        }

        return route($prefix . '.news.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.news.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.news.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.news.remove-image', $this->id);
    }

    public function renderRequestVisitUrl() {
        return route('web.request-to-visit', [$this->id, $this->name]);
    }

}
