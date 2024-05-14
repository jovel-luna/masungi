<?php

namespace App\Models\Experiences;

use App\Extenders\Models\BaseModel as Model;
use Illuminate\Validation\ValidationException;

use App\Models\Trails\Trail;
use App\Models\TrailStops\TrailStop;
use App\Models\ExperienceInformations\ExperienceInformation;

use Carbon\Carbon;

class Experience extends Model
{

    public function trails()
    {
        return $this->hasMany(Trail::class)->withTrashed();
    }

    public function experienceinformation()
    {
        return $this->hasMany(ExperienceInformation::class)->withTrashed();
    }

    public function trailStops()
    {
        return $this->hasMany(TrailStop::class)->withTrashed();
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['name', 'capacity_per_day', 'operating_hours', 'operating_hours_end'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        return $item;
    }

    /* Archive Item */
    public function archive() {
        if (!$this->trashed() && $this->isArchiveable()) {
            $this->delete();
            foreach ($this->trails as $key => $trail) {
               $trail->delete();
            }
        } else {
            throw ValidationException::withMessages([
                'deleted_at' => $this->archiveErrorMessage(),
            ]);
        }

        return true;
    }

    /* Restore Item */
    public function unarchive() {
        if ($this->trashed() && $this->isRestorable()) {
            $this->restore();
            foreach ($this->trails as $key => $trail) {
                /* Check if record has been deleted today */
                // if($trail->deleted_at->isToday()) {
                    $trail->restore();
                // }
            }
        } else {
            throw ValidationException::withMessages([
                'deleted_at' => $this->restoreErrorMessage(),
            ]);
        }

        return true;
    }

    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.experiences.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.experiences.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.experiences.restore', $this->id);
    }
}
