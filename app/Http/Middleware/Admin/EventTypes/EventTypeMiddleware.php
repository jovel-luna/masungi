<?php

namespace App\Http\Middleware\Admin\EventTypes;

use App\Extenders\BaseMiddleware as Middleware;

class EventTypeMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.eventtypes.crud'];
    }
}
