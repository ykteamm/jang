<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'https://jang.novatio.uz/name-etap',
        'https://jang.novatio.uz/date-etap',
        'https://jang.novatio.uz/region-etap',
        'https://jang.novatio.uz/passport-etap',
        'https://jang.novatio.uz/photo-etap',
        'https://jang.novatio.uz/lavozim-etap',
        'https://jang.novatio.uz/phone-etap',
        'https://jang.novatio.uz/code-etap',
        'https://jang.novatio.uz/parol-etap',
        'https://jang.novatio.uz/login',
        'http://127.0.0.1:8000/name-etap',
        'http://127.0.0.1:8000/date-etap',
        'http://127.0.0.1:8000/region-etap',
        'http://127.0.0.1:8000/passport-etap',
        'http://127.0.0.1:8000/photo-etap',
        'http://127.0.0.1:8000/lavozim-etap',
        'http://127.0.0.1:8000/phone-etap',
        'http://127.0.0.1:8000/code-etap',
        'http://127.0.0.1:8000/parol-etap',
    ];
}
