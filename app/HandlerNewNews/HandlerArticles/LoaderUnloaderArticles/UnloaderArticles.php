<?php

namespace App\HandlerNewNews\HandlerArticles\LoaderUnloaderArticles;

use Illuminate\Support\Facades\DB;

class UnloaderArticles
{
    public static function startUpload(): object
    {
        return DB::table('articles')
            ->orderBy('date', 'desc')
            ->select('date', 'title', 'url', 'logo')
            ->limit(270)
            ->get();
    }
}
