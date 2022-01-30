<?php

namespace App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls;

use App\Models\NewsUrls;
use Illuminate\Support\Facades\DB;

class LoaderNewsUrls
{
    public static function startLoad(array $arrNewsUrls): void
    {
//        $a = new NewsUrls();
//        $a->url = $arrNewsUrls[0]['urlWebSite'];
//        $a->logo = $arrNewsUrls[0]['logoWebSite'];
//        $a->name = $arrNewsUrls[0]['nameWebSite'];
//        $a->save();

//        DB::enableQueryLog();
//        NewsUrls::updateOrCreate(
//            ['url' => $arrNewsUrls['urlWebSite']],
//            ['logo'=> $arrNewsUrls['logoWebSite'], 'name'=>$arrNewsUrls['nameWebSite']]
//        );

//        $data = NewsUrls::where('url', $arrNewsUrls['urlWebSite'])->first();
//        if ($data) {
//            $x = NewsUrls::where('url', $arrNewsUrls['urlWebSite'])
//                ->update(['logo'=> $arrNewsUrls['logoWebSite'], 'name'=>$arrNewsUrls['nameWebSite']]);
//            print_r($x);
//        }

        $bool = NewsUrls::where('url', $arrNewsUrls['urlWebSite'])
            ->update(['logo'=> $arrNewsUrls['logoWebSite'], 'name'=>$arrNewsUrls['nameWebSite']]);

        if (!$bool) {
            NewsUrls::create([
                'url' => $arrNewsUrls['urlWebSite'],
                'logo' => $arrNewsUrls['logoWebSite'],
                'name' => $arrNewsUrls['nameWebSite']
            ]);

        }
//        dd(DB::getQueryLog());


    }

}
