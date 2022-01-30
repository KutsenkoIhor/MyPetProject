<?php

namespace App\HandlerNewNews\HandlerArticles\Reconstruction;

use PicoFeed\Parser\Feed;

class ReconstructionBeforeLoad
{
    private Feed $arrNewsArticle;

    public function __construct(Feed $arrNewsArticle)
    {
        $this->arrNewsArticle = $arrNewsArticle;
    }

    public function startReconstruction(): array
    {
        $arrAllNews = [];
        $urlWebSite = $this->handlerWebSite();
        $logoWebSite = $this->handlerLogo();
        $nameWebSite = $this->handlerName();
        foreach ($this->arrNewsArticle->items as $key => $value) {
            $arr = [];
            $arr['title'] = $this->handlerTitle($value);
            $arr['url'] = $this->handlerUrl($value);
            $arr['EnclosureUrl'] = $this->handlerEnclosureUrl($value);
            $arr['logoWebSite'] = $logoWebSite;
            $arr['date'] = $this->handlerDate($value);
            $arr['nameWebSite'] = $nameWebSite;
            $arr['urlWebSite'] = $urlWebSite;
            $arrAllNews[$key] = $arr;
        }
        return $arrAllNews;
    }

    private function handlerWebSite(): string
    {
        return $this->arrNewsArticle->getSiteUrl();
    }

    private function handlerName(): string
    {
        return $this->arrNewsArticle->getTitle();
    }

    private function handlerEnclosureUrl($value): string
    {
        return $value->getEnclosureUrl();
    }

    private function handlerLogo(): string
    {
        return $this->arrNewsArticle->getlogo();
    }

    private function handlerTitle($value): string
    {
        $title = $value->getTitle();
        return htmlspecialchars_decode($title);
    }

    private function handlerUrl($value): string
    {
        return $value->getUrl();
    }

    private function handlerDate($value): string
    {
        $date = $value->getDate();
        if ($date !== null) {
            $timeUnix = $date->getOffset() + $date->getTimestamp();
        } else {
            $timeUnix = time();
        }
        return date('Y-m-d H:i:s', $timeUnix);
    }
}
