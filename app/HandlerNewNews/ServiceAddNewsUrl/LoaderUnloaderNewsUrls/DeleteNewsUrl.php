<?php

namespace App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls;

use App\Models\NewsUrls;

class DeleteNewsUrl
{
    public static function startDelete(string $NewsUrl): void
    {
        NewsUrls::where('url', $NewsUrl)->delete();
    }

}
