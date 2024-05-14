<?php

namespace App\Http\Middleware\Admin\Galleries;

use App\Extenders\BaseMiddleware as Middleware;

class GalleryMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.galleries.crud'];
    }
}
