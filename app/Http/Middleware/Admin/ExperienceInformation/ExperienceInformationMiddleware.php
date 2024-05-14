<?php

namespace App\Http\Middleware\Admin\ExperienceInformation;

use App\Extenders\BaseMiddleware as Middleware;

class ExperienceInformationMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.experience-information.crud'];
    }
}
