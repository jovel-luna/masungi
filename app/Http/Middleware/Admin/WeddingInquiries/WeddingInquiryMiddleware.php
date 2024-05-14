<?php

namespace App\Http\Middleware\Admin\WeddingInquiries;

use App\Extenders\BaseMiddleware as Middleware;

class WeddingInquiryMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.weddinginquiries.crud'];
    }
}
