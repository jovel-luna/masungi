<?php

namespace App\Http\Middleware\Admin\Venues;

use App\Extenders\BaseMiddleware as Middleware;

class VenueMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.venues.crud'];
    }
}
