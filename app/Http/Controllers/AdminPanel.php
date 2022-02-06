<?php

namespace App\Http\Controllers;

use App\HandlerNewNews\HandlerArticles\Reconstruction\ReconstructionBeforeLoad;
use App\HandlerNewNews\Parser\Parser;
use App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls\ChangeStatusNewsUrls;
use App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls\DeleteNewsUrl;
use App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls\LoaderNewsUrls;
use App\HandlerNewNews\ServiceAddNewsUrl\LoaderUnloaderNewsUrls\UnloaderNewsUrls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AdminPanel extends Controller
{

    public function showAdminPanel () {
        $data = UnloaderNewsUrls::startUnload();
        return view('page/adminPanel', ['data' => $data ]);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function changeStatusOfSource(Request $request): void
    {
        $request->input('state') === "true" ? $state = 1 : $state = 0;
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

        $objfeed = new ReconstructionBeforeLoad($feed);
        $arr = $objfeed->startReconstruction()[0];
        $arr['urlWebSite'] = $request->input('newUrl');

        LoaderNewsUrls::startLoad($arr);
        return redirect(route('admin.admin'));
    }
}
