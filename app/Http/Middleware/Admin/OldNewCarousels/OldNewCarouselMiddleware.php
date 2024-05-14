<?php

namespace App\Http\Middleware\Admin\OldNewCarousels;

use App\Extenders\BaseMiddleware as Middleware;

class OldNewCarouselMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.oldnewcarousels.crud'];
    }
}
