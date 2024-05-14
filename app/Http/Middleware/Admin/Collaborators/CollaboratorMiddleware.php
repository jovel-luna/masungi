<?php

namespace App\Http\Middleware\Admin\Collaborators;

use App\Extenders\BaseMiddleware as Middleware;

class CollaboratorMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.collaborators.crud'];
    }
}
