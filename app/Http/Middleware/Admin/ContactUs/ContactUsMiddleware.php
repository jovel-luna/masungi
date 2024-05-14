<?php

namespace App\Http\Middleware\Admin\ContactUs;

use App\Extenders\BaseMiddleware as Middleware;

class ContactUsMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.contactus.crud'];
    }
}
