<?php

namespace App\Models\WeddingInquiries;

use App\Extenders\Models\BaseModel as Model;

class WeddingInquiry extends Model
{
    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.weddinginquiries.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.weddinginquiries.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.weddinginquiries.restore', $this->id);
    }


    public function renderWebHome() {
        return route('web.home');
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['fullname', 'email','contact_number', 'date', 'eventtype', 'guestsnumber','message'])
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
