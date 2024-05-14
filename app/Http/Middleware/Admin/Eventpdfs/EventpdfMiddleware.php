<?php

namespace App\Http\Middleware\Admin\Eventpdfs;

use App\Extenders\BaseMiddleware as Middleware;

class EventpdfMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.eventpdfs.crud'];
    }
}
