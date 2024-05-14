<?php

namespace App\Http\Middleware\Admin\EventInformations;

use App\Extenders\BaseMiddleware as Middleware;

class EventInformationMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.eventinformations.crud'];
    }
}
