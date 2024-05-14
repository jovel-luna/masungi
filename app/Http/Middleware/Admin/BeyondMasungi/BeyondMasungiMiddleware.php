<?php

namespace App\Http\Middleware\Admin\BeyondMasungi;

use App\Extenders\BaseMiddleware as Middleware;

class BeyondMasungiMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.beyondmasungi.crud'];
    }
}
