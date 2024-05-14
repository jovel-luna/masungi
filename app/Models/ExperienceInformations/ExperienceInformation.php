<?php

namespace App\Models\ExperienceInformations;

use App\Extenders\Models\BaseModel as Model;
use App\Models\Experiences\Experience;
use App\Traits\FileTrait;
use App\Traits\ManyImagesTrait;

use App\Models\Files\File;
use App\Models\Picture;


class ExperienceInformation extends Model
{
    use FileTrait, ManyImagesTrait;

    public function experience()
    {
        return $this->belongsTo(Experience::class)->withTrashed();
    }

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
    public static function store($request, $item = null, $columns = ['experience_id', 'duration', 'terrain', 'age_group', 'conservation_fees', 'overview', 'trail_characteristics', 'ideal_for', 'inclusions', 'good_to_know', 'conservation_fee_detail', 'visit_request'])
    {

        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('images')) {
            $item->addImages($request->file('images'));
        }

        return $item;
    
}
    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.experience-information.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.experience-information.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.experience-information.restore', $this->id);
    }

    public function renderRemoveImageUrl($prefix = 'admin') {
        return route($prefix . '.experience-information.remove-image', $this->id);
    }

    public function renderRequestVisitUrl() {
        return route('web.request-to-visit', [$this->id, $this->name]);
    }
    
    public function renderExperience() {
        return $this->experience->name;
    }

}
