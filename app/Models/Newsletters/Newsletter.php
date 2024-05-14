<?php

namespace App\Models\Newsletters;

use App\Extenders\Models\BaseModel as Model;

class Newsletter extends Model
{
   /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.newsletters.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.newsletters.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.newsletters.restore', $this->id);
    }


    public function renderWebHome() {
        return route('web.home');
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['email'])
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
