<?php

namespace App\HandlerNewNews\HandlerArticles\Reconstruction;

use App\HandlerNewNews\HandlerImg\HandleTextForImage;
use App\HandlerNewNews\HandlerImg\ServiceImg;
use App\Models\Article;
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

    private function uniqueNews($value, $key)//пропускаем первую новость для добавление информации в админ панель
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

    private function handlerLogo(): string
    {
        return $this->arrNewsArticle->getlogo();
    }

    private function handlerTitle($value): string
    {
        $title = $value->getTitle();
        return htmlspecialchars_decode($title);
    }

    private function handlerTitleTheSameLength($value): string
    {
        $title = $this->handlerTitle($value);
        $maxLongString = 120;
        $arr = HandleTextForImage::start($title, $maxLongString);
        $text = $arr[0] . "...";

        if (iconv_strlen($text) <= 122){
            $delta = 122 - iconv_strlen($text);
            for ($i = 0; $i <= $delta; $i++) {
                $text = $text . " ";
            }
            return $text;
        } else {
            return $text;
        }
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
