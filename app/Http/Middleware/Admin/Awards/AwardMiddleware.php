<?php

namespace App\Http\Middleware\Admin\Awards;

use App\Extenders\BaseMiddleware as Middleware;

class AwardMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.awards.crud'];
    }
}
