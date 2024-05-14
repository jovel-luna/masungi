<?php

namespace App\Http\Middleware\Admin\Researches;

use App\Extenders\BaseMiddleware as Middleware;

class ResearchMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.researches.crud'];
    }
}
