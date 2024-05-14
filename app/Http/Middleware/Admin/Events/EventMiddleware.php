<?php

namespace App\Http\Middleware\Admin\Events;

use App\Extenders\BaseMiddleware as Middleware;

class EventMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.events.crud'];
    }
}
