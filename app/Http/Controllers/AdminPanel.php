<?php

namespace App\Http\Controllers;

use App\HandlerNewNews\HandlerArticles\Reconstruction\ReconstructionBeforeLoad;
use App\HandlerNewNews\HandlerImg\HandlerImg;
use App\HandlerNewNews\Parser\Parser;
use App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls\ChangeStatusNewsUrls;
use App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls\DeleteNewsUrl;
use App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls\LoaderNewsUrls;
use App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls\UnloaderNewsUrls;
use App\Models\NewsUrls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AdminPanel extends Controller
{
    public function showAdminPanel () {
        $data = UnloaderNewsUrls::startUnload();
        return view('page/settings', ['data' => $data ]);

//        $url = "https://img.tsn.ua/cached/529/tsn-2e5933e84c8f120777c30b7610ecadcd/thumbs/550xX/a7/a5/db85c353bcbc453975a38dc47692a5a7.jpeg";
//
//        //загрузка картинок
//        $contents = file_get_contents($url);
//        $path = getcwd() . "/storage/";
//        $name = basename($url);
//        Storage::put("public/" . $name, $contents);
////        $size = getimagesize("http://www.google.co.in/intl/en_com/images/srpr/logo1w.png");
//        $size = getimagesize($path . $name);
//        print_r($size);
//        print_r($path . $name);
//        $obj = new HandlerImg();
//        $obj->load("https://img.tsn.ua/cached/204/tsn-2e5933e84c8f120777c30b7610ecadcd/thumbs/550xX/a7/a1/4d277d47f5f387b24d7a54d1dee3a1a7.jpeg");
//        $obj->crop();
//        $obj->save($path . 'image12.jpg');


    }

    public function changeStatusOfSource(Request $request)
    {
        if ($request->input('state') === "true") {
            $state = 1;
        } else {
            $state = 0;
        }
        ChangeStatusNewsUrls::startChangStatus($request->input('id'), $state);
    }

    public function deleteNewsUrl(Request $request)
    {
        DeleteNewsUrl::startDelete($request->input('delete'));
        return redirect(route('admin.admin'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('admin.login'));
    }

    public function addNewsUrl(Request $request)
    {
        try {
            $obj = new Parser($request->input('newUrl'));
            $feed = $obj->dissection();
        } catch (Throwable $e) {
            return redirect(route('admin.admin'))->withErrors([
                'ErrorUrl' => 'URL parsing error'
            ]);
        }

        $test = new ReconstructionBeforeLoad($feed);
        $arr = $test->startReconstruction()[0]; // take only key [0]
        $arr['urlWebSite'] = $request->input('newUrl');

        LoaderNewsUrls::startLoad($arr);
        return redirect(route('admin.admin'));
    }
}
