<?php

namespace App\Http\Middleware\Admin\PreviousGuests;

use App\Extenders\BaseMiddleware as Middleware;

class PreviousGuestMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.previousguests.crud'];
    }
}
