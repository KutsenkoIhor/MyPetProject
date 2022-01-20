<?php

namespace App\HandlerNewNews\HandlerArticles\LoaderArticles;

use Illuminate\Support\Facades\DB;

class Loader
{
    public static function startLoad(array $arrNewsArticle): void
    {
        foreach ($arrNewsArticle as $value) {
            DB::table('articles')->insertOrIgnore([
                'title' => $value['title'],
                'url' => $value['url'],
                'logo' => $value['logo'],
                'date' => $value['date']
            ]);
        }
    }
}
