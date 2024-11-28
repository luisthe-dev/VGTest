<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Helper
{

    public static function generateRandomString($length = 8)
    {
        return Str::random($length);
    }
}
