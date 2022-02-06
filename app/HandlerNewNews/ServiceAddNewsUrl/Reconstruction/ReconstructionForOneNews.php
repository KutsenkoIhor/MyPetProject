<?php

namespace App\HandlerNewNews\ServiceAddNewsUrl\Reconstruction;

use App\HandlerNewNews\HandlerArticles\Reconstruction\ReconstructionBeforeLoad;

class ReconstructionForOneNews extends ReconstructionBeforeLoad
{
    /**
     * @param string $url
     * @return array
     */
    public function startReconstructionForOneNews(string $url): array
    {
        $arrAllNews = [];
        $arrAllNews['urlWebSite'] = $url;
        $arrAllNews['logoWebSite'] = $this->handlerLogo();
        $arrAllNews['nameWebSite'] = $this->handlerName();
        return $arrAllNews;
    }
}
