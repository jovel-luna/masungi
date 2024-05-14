<?php

namespace App\Http\Middleware\Admin\Trails;

use App\Extenders\BaseMiddleware as Middleware;

class TrailMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.trails.crud'];
    }
}
