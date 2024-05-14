<?php

namespace App\Models\SchoolInquiries;

use App\Extenders\Models\BaseModel as Model;

use App\Models\Trails\Trail;

class SchoolInquiry extends Model
{

    public function trail() {
        return $this->belongsTo(Trail::class)->withTrashed();
    }

    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.schoolinquiries.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.schoolinquiries.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.schoolinquiries.restore', $this->id);
    }


    public function renderWebHome() {
        return route('web.home');
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['name', 'leadcontact','position', 'email', 'contact_number', 'yearlevel','preferreddate','preferredtime','trail_id','concerns'])
    {
        $vars = $request->only($columns);
        
        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        return $item;
    }

}
