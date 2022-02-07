<?php

namespace App\Http\Controllers;

use App\HandlerNewNews\HandlerArticles\LoaderUnloaderArticles\UnloaderArticles;
use App\HandlerNewNews\HandlerArticles\Reconstruction\ReconstructionAfterLoad;

class ArticleController extends Controller
{
    private ReconstructionAfterLoad $reconstructionService;

    public function __construct(ReconstructionAfterLoad $reconstructionService)
    {
        $this->reconstructionService =  $reconstructionService;
    }

    public function showArticles()
    {
        $objArticles = UnloaderArticles::startUpload();

        $this->reconstructionService->setArticle($objArticles);
        $articles = $this->reconstructionService->reconstruct();

        return view('page/showArticles', ['arrData' => $articles]);
    }
}
