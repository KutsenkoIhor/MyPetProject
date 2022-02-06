<?php

namespace App\HandlerNewNews\HandlerArticles\Reconstruction;

use App\HandlerNewNews\HandlerImg\ServiceImg;
use App\Models\Article;
use PicoFeed\Parser\Feed;

class ReconstructionBeforeLoad
{
    private Feed $arrNewsArticle;

    /**
     * @param Feed $arrNewsArticle
     */
    public function __construct(Feed $arrNewsArticle)
    {
        $this->arrNewsArticle = $arrNewsArticle;
    }

    /**
     * @return array
     */
    public function startReconstruction(): array
    {
        $arrAllNews = [];
        $urlWebSite = $this->handlerWebSite();
        $logoWebSite = $this->handlerLogo();
        $nameWebSite = $this->handlerName();
        foreach ($this->arrNewsArticle->items as $key => $value) {
            if ($this->uniqueNews($value, $key)) {
                continue;
            }
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

    /**
     * @param $value
     * @param $key
     * @return bool
     */
    private function uniqueNews($value, $key): bool
    {
        if (Article::where('url', $value->getUrl())->first()){
            if ($key === 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    private function handlerWebSite(): string
    {
        return $this->arrNewsArticle->getSiteUrl();
    }

    /**
     * @return string
     */
    private function handlerName(): string
    {
        return $this->arrNewsArticle->getTitle();
    }

    /**
     * @param $value
     * @return string
     */
    private function handlerEnclosureUrl($value): string
    {
        if ($value->getEnclosureUrl()) {
            $objImg = new ServiceImg($this->handlerTitle($value), $value->getEnclosureUrl());
            $objImg->load();
            $objImg->crop();
            $objImg->save();
            return $objImg->getPath();
        }
        $objImg = new ServiceImg($this->handlerTitle($value));
        $objImg->load();
        $objImg->createImg();
        $objImg->save();
        return $objImg->getPath();
    }

    /**
     * @return string
     */
    private function handlerLogo(): string
    {
        return $this->arrNewsArticle->getlogo();
    }

    /**
     * @param $value
     * @return string
     */
    private function handlerTitle($value): string
    {
        $title = $value->getTitle();
        return htmlspecialchars_decode($title);
    }

    /**
     * @param $value
     * @return string
     */
    private function handlerUrl($value): string
    {
        return $value->getUrl();
    }

    /**
     * @param $value
     * @return string
     */
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
