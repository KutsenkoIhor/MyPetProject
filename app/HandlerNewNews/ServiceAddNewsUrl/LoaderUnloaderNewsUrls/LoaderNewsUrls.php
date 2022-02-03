<?php

namespace App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls;

use App\Models\NewsUrls;
use Illuminate\Support\Facades\DB;

class LoaderNewsUrls
{
    public static function startLoad(array $arrNewsUrls): void
    {
        $bool = NewsUrls::where('url', $arrNewsUrls['urlWebSite'])
            ->update(['logo'=> $arrNewsUrls['logoWebSite'], 'name'=>$arrNewsUrls['nameWebSite']]);

        if (!$bool) {
            NewsUrls::create([
                'url' => $arrNewsUrls['urlWebSite'],
                'logo' => $arrNewsUrls['logoWebSite'],
                'name' => $arrNewsUrls['nameWebSite']
            ]);
        }
    }
}
