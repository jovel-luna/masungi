<?php

namespace App\Http\Middleware\Admin\Bankdetails;

use App\Extenders\BaseMiddleware as Middleware;

class BankdetailMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.bankdetails.crud'];
    }
}
