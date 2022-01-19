<?php

namespace App\HandlerNewNews\InitializeQueue;

use App\Models\NewsUrls;

class InitializeQueue
{
    public static function start(): void
    {
        foreach (NewsUrls::all() as $value)
        {
            print_r($value->url);
        }
    }
}
//$val = RSS_feeds::find(1);
////        print_r($val->feed . "\n");
//TrackParser::dispatch($val->feed);
