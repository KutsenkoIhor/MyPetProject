<?php

namespace App\HandlerNewNews\HandlerArticles\LoaderUnloaderArticles;

use Illuminate\Support\Facades\DB;

class LoaderArticles
{
    public static function startLoad(array $arrNewsArticle): void
    {
        foreach ($arrNewsArticle as $value) {
            DB::table('articles')->insertOrIgnore([
                'title' => $value['title'],
                'url' => $value['url'],
                'image_news' => $value['EnclosureUrl'],
                'date' => $value['date'],
                'name_news_channel' => $value['nameWebSite']
            ]);
        }
    }
}
