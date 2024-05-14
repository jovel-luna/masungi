<?php

namespace App\Http\Middleware\Admin\InformationKits;

use App\Extenders\BaseMiddleware as Middleware;

class InformationKitMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.informationkits.crud'];
    }
}
