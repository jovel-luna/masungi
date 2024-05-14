<?php

namespace App\Models\ContactUs;

use App\Extenders\Models\BaseModel as Model;

class ContactUs extends Model
{
    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.contactus.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.contactus.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.contactus.restore', $this->id);
    }


    public function renderWebHome() {
        return route('web.home');
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['firstname', 'lastname','contact_number', 'email', 'affliation', 'nationality','message'])
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
