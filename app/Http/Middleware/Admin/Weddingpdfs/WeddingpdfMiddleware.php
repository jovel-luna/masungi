<?php

namespace App\Http\Middleware\Admin\Weddingpdfs;

use App\Extenders\BaseMiddleware as Middleware;

class WeddingpdfMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.weddingpdfs.crud'];
    }
}
