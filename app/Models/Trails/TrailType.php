<?php

namespace App\Models\Trails;

use App\Extenders\Models\BaseModel as Model;

use App\Models\TimeSlots\TimeSlot;

class TrailType extends Model
{
	/*
	 * Relationship
	 */
	
    public function timeSlots() {
    	return $this->hasMany(TimeSlot::class, 'trail_type_id')->withTrashed();
    }
}
