<?php

namespace App\Http\Middleware\Admin\Features;

use App\Extenders\BaseMiddleware as Middleware;

class FeatureMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.features.crud'];
    }
}
