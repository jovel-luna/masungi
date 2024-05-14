<?php

namespace App\Http\Middleware\Admin\SchoolInquiries;

use App\Extenders\BaseMiddleware as Middleware;

class SchoolInquiryMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.schoolinquiries.crud'];
    }
}
