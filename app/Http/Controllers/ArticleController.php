<?php

namespace App\Http\Controllers;

use App\HandlerNewNews\HandlerArticles\LoaderUnloaderArticles\UnloaderArticles;
use App\HandlerNewNews\HandlerArticles\Reconstruction\ReconstructionAfterLoad;

class ArticleController extends Controller
{
    public function showArticles()
    {
        $objArticles = UnloaderArticles::startUpload();

        $objReconstruction  = new ReconstructionAfterLoad($objArticles);
        $articles = $objReconstruction->reconstruct();

        return view('page/showArticles', ['arrData' => $articles]);
    }
}
