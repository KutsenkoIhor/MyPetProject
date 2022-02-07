<?php

namespace App\HandlerNewNews\HandlerArticles\Reconstruction;

class ReconstructionAfterLoad
{
    private object $objNewsArticle;

    public function setArticle(object $objNewsArticle)
    {
        $this->objNewsArticle = $objNewsArticle;
    }

    /**
     * @return array
     */
    public function reconstruct(): array
    {
        $arrData = [];
        foreach ($this->objNewsArticle as $key => $value) {
            $arr = [];
            $arr['title'] = $value->title;
            $arr['date'] = $this->getTime($value);
            $arr['url'] = $value->url;
            $arr['image_news'] = $value->image_news;
            $arr['name_news_channel'] = $value->name_news_channel;
            $arrData[$key] = $arr;
        }
        return $arrData;
    }

    /**
     * @param $value
     * @return string
     */
    private function getTime($value): string
    {
        $timestamp = strtotime($value->date);
        $timeNow = time() + 7200;
        $differenceInTime = $timeNow - $timestamp;

        if ($timestamp > $timeNow) {
            return 'Last updated now';
        } elseif (date('Y-m-d', $timeNow) !== date('Y-m-d', $timestamp)) {
            return date('d F Y', $timestamp);
        } else {
            if ($differenceInTime > 3600) {
                return date('G', $differenceInTime) . ' hours ago';
            } else {
                return date('i', $differenceInTime). ' minutes ago';
            }
        }
    }
}

