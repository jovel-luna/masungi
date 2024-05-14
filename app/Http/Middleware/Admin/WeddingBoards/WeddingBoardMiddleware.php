<?php

namespace App\Http\Middleware\Admin\WeddingBoards;

use App\Extenders\BaseMiddleware as Middleware;

class WeddingBoardMiddleware  extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.weddingboards.crud'];
    }
}
