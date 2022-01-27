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
//        $logo = $this->handlerLogo();
        foreach ($this->arrNewsArticle->items as $key => $value) {
            $arr = [];
            $arr['title'] = $this->handlerTitle($value);
            $arr['url'] = $this->handlerUrl($value);
//            $arr['logo'] = $logo;
            $arr['logo'] = $this->handlerLogo($value);
            $arr['date'] = $this->handlerDate($value);
            $arrAllNews[$key] = $arr;
        }
        return $arrAllNews;
    }

    private function handlerLogo($value): string
    {
//        return $this->arrNewsArticle->getlogo();
        return $value->getEnclosureUrl();
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
