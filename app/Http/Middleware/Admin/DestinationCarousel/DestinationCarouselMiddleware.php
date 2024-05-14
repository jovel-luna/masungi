<?php

namespace App\Http\Middleware\Admin\DestinationCarousel;

use App\Extenders\BaseMiddleware as Middleware;

class DestinationCarouselMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.destinationcarousel.crud'];
    }
}
