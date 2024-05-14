<?php

namespace App\Models\Declarations;

use App\Extenders\Models\BaseModel as Model;

class Declaration extends Model
{

    protected $appends = ['is_checked'];

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['body'])
    {
        $vars = $request->only($columns);

        $vars['is_required'] = $request->is_required ? 1: 0;

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        return $item;
    }

    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        return route($prefix . '.declarations.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.declarations.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.declarations.restore', $this->id);
    }

    /**
     * Appends formatted time
     * 
     * @return string
     */
    public function getIsCheckedAttribute()
    {
        return false;
    }
}
