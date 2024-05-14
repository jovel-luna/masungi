<?php

namespace App\Http\Middleware\Admin\TimeSlots;

use App\Extenders\BaseMiddleware as Middleware;

class TimeSlotMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.time-slots.crud'];
    }
}
