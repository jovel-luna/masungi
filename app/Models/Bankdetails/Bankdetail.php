<?php

namespace App\Models\Bankdetails;

use App\Extenders\Models\BaseModel as Model;

use App\Traits\FileTrait;

class Bankdetail extends Model
{
    use FileTrait;

    protected $table = 'bankdetails_tables';


    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['name', 'acctnumber'])
    {
        $vars = $request->only($columns);

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
    
    public static function formatItem($item) {
        return [
            'name' => $item->name,
            'acctnumber' => $item->acctnumber,
        ];
    }    
    
    public function renderName() {
        return $this->name;
    }

    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.bankdetails.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.bankdetails.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.bankdetails.restore', $this->id);
    }

}
