<?php

namespace App\HandlerNewNews\Parser;

use PicoFeed\Parser\Feed;
use PicoFeed\Reader\Reader;

class Parser
{
    private string $url;

    public function __construct(string $url = null)
    {
        $this->url = $url;
    }

    public function dissection(): Feed
    {
        $reader = new Reader;
        $resource = $reader->download($this->url);
        $parser = $reader->getParser(
            $resource->getUrl(),
            $resource->getContent(),
            $resource->getEncoding()
        );
        return $parser->execute();

//        $arrNewsArticle = [];
//        $logo = $feed->getLogo();
//        foreach ($feed->items as $key => $newsArticle) {
//            $arr = [];
//            $arr['title'] = $newsArticle->getTitle();
//            $arr['url'] = $newsArticle->getUrl();
//            $arr['logo'] = $logo;
//
//            $date = $newsArticle->getDate();
//            if ($date !== null) {
//                $arr['date'] = $date->getOffset() + $date->getTimestamp();
//            } else {
//                $arr['date'] = null;
//            }
//
//            $arrNewsArticle[$key] = $arr;
//        }
//        return $arrNewsArticle;
        //        foreach ($this->arrNewsArticle as &$value) {
//            $value['date'] = date('Y-m-d H:i:s', $value['date']);
//        }
//        return "f";
    }
}
