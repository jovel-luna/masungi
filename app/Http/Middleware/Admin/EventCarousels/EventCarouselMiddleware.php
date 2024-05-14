<?php

namespace App\Http\Middleware\Admin\EventCarousels;

use App\Extenders\BaseMiddleware as Middleware;

class EventCarouselMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.eventcarousels.crud'];
    }
}
