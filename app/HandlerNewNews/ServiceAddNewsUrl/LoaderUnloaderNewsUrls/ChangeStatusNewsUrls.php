<?php

namespace App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls;

use App\Models\NewsUrls;

class ChangeStatusNewsUrls
{
    public static function startChangStatus(string $id, string $status): void
    {
        NewsUrls::where('id', $id)
            ->update(['active' => $status]);
    }
}
