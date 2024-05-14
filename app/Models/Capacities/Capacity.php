<?php

namespace App\Models\Capacities;

use App\Extenders\Models\BaseModel as Model;

use App\Models\Trails\Trail;

class Capacity extends Model
{
    
    /*
     * Relationship
     */
    
	public function trail()
	{
		return $this->belongsTo(Trail::class)->withTrashed();
	}

	/**
	 * @Setters
	 */
	public static function store($request, $item = null, $columns = ['trail_id', 'capacity'])
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
	public function renderShowUrl($prefix = 'admin') {
	    return route($prefix . '.capacities.show', $this->id);
	}

	public function renderArchiveUrl($prefix = 'admin') {
	    return route($prefix . '.capacities.archive', $this->id);
	}

	public function renderRestoreUrl($prefix = 'admin') {
	    return route($prefix . '.capacities.restore', $this->id);
	}

}
