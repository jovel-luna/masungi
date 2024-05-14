<?php

namespace App\Models\TrailStops;

use App\Extenders\Models\BaseModel as Model;

use App\Models\Experiences\Experience;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\Files\File;
use App\Models\Picture;
use App\Models\Trails\Trail;

class TrailStop extends Model
{
    use FileTrait, ManyImagesTrait;

    protected $appends = ['fullpath'];

    public function trail() 
    {
    	return $this->belongsTo(Trail::class)->withTrashed();
    }


    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['trail_id','name', 'description'])
  {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'trail-stops');
        }

        return $item;
    }

    public function getFullpathAttribute()
    {
        return $this->renderImagePath();
    }


    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        return route($prefix . '.trailstops.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.trailstops.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.trailstops.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.trailstops.remove-image', $this->id);
    }
}
