<?php

namespace App\Http\Middleware\Admin\WeddingVenues;

use App\Extenders\BaseMiddleware as Middleware;

class WeddingVenueMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.weddingvenues.crud'];
    }
}
