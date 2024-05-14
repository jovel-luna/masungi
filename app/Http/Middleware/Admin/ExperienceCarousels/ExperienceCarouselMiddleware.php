<?php

namespace App\Http\Middleware\Admin\ExperienceCarousels;

use App\Extenders\BaseMiddleware as Middleware;

class ExperienceCarouselMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.experiencecarousels.crud'];
    }
}
