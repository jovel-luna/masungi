<?php

namespace App\Http\Middleware\Admin\Georeservepolicies;

use App\Extenders\BaseMiddleware as Middleware;

class GeoreservepolicyMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.georeservepolicies.crud'];
    }
}
