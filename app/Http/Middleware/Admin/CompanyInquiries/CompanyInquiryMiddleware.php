<?php

namespace App\Http\Middleware\Admin\CompanyInquiries;

use App\Extenders\BaseMiddleware as Middleware;

class CompanyInquiryMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.companyinquiries.crud'];
    }
}
