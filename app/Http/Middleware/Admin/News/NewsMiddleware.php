<?php

namespace App\Http\Middleware\Admin\News;

use App\Extenders\BaseMiddleware as Middleware;

class NewsMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.news.crud'];
    }
}
