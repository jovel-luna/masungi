<?php

namespace App\Http\Middleware\Admin\Newsletters;

use App\Extenders\BaseMiddleware as Middleware;

class NewsletterMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.newsletters.crud'];
    }
}
