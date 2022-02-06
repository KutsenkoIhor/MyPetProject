<?php

namespace App\HandlerNewNews\HandlerArticles\LoaderUnloaderArticles;

use App\Models\Article;

class UnloaderArticles
{
    /**
     * @return object
     */
    public static function startUpload(): object
    {
        return Article::orderBy('date', 'desc')
            ->select('date', 'title', 'url', 'image_news', 'name_news_channel')
            ->paginate(12);
    }
}
