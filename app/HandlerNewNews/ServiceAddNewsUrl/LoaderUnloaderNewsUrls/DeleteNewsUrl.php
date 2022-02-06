<?php

namespace App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls;

use App\Models\NewsUrls;

class DeleteNewsUrl
{
    /**
     * @param string $NewsUrl
     * @return void
     */
    public static function startDelete(string $NewsUrl): void
    {
        NewsUrls::where('url', $NewsUrl)->delete();
    }
}
