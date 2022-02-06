<?php

namespace App\HandlerNewNews\InitializeQueue;

use App\Jobs\ParserNews;
use App\Models\NewsUrls;

class InitializeQueue
{
    /**
     * @return void
     */
    public static function start(): void
    {
        foreach (NewsUrls::where('active', 1)->get() as $value)
        {
            ParserNews::dispatch($value->url);
        }
    }
}


