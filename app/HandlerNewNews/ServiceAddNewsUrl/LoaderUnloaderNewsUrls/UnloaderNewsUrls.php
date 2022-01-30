<?php

namespace App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls;

use App\Models\NewsUrls;

class UnloaderNewsUrls
{
    public static function startUnload()
    {
        return NewsUrls::all();
    }
}
