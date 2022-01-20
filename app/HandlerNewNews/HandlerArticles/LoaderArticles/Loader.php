<?php

namespace App\HandlerNewNews\HandlerArticles\LoaderArticles;

use App\Models\Article;
use Illuminate\Support\Facades\DB;

class Loader
{
    private array $arrNewsArticle;

    public function __construct(array $arrNewsArticle)
    {
        $this->arrNewsArticle = $arrNewsArticle;
    }

    public function load(): void
    {
        $arr = ['title' => 'Сюжетный трейлер Horizon Forbidden West: знакомство с новыми персонажами и встреча старых друзей',
            'url' => 'https://itc.ua/news/syuzhetnyj-trejler-horizon-forbidden-west-znakomstvo-s-novymi-personazhami-i-vstrecha-staryh-druzej/',
            'logo' => 'https://itc.ua/wp-content/uploads/2016/07/cropped-itc-favicon-32x32.png',
            'date' => '2022-01-20 11:25:34'
            ];
//        print_r($this->arrNewsArticle);
        print_r($arr['date']);

        DB::table('articles')->insert([
            'title' => $arr['title'],
            'url' => $arr['url'],
            'logo' => $arr['logo'],
            'date' => $arr['date']
        ]);



    }

}
