<?php

namespace App\Http\Controllers;

use App\HandlerNewNews\HandlerArticles\LoaderUnloaderArticles\UnloaderArticles;
use App\HandlerNewNews\HandlerArticles\Reconstruction\ReconstructionAfterLoad;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showArticles()
    {
        $objArticles = UnloaderArticles::startUpload();

        $objReconstruction  = new ReconstructionAfterLoad($objArticles);
        $articls = $objReconstruction->reconstruct();

        return view('articles/showArticles', ['tagsss' => $articls]);
    }
}
