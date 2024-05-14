<?php

namespace App\Http\Middleware\Admin\Pdflinks;

use App\Extenders\BaseMiddleware as Middleware;

class PdflinkMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.pdflinks.crud'];
    }
}
