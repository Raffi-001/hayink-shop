<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EncryptCookies extends \Illuminate\Cookie\Middleware\EncryptCookies
{
    protected $except = [
        'app_locale',
    ];
}
