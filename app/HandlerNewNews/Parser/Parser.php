<?php

namespace App\HandlerNewNews\Parser;

use PicoFeed\Reader\Reader;

class Parser
{
    private string $url;

    public function __construct(string $url = null)
    {
        $this->url = $url;
    }

    public function dissection(): array
    {
        $reader = new Reader;
        $resource = $reader->download($this->url);
        $parser = $reader->getParser(
            $resource->getUrl(),
            $resource->getContent(),
            $resource->getEncoding()
        );
        $feed = $parser->execute();

        $arrNewsArticle = [];
        $logo = $feed->getLogo();
        foreach ($feed->items as $key => $newsArticle) {
            $arr = [];
            $arr['title'] = $newsArticle->getTitle();
            $arr['url'] = $newsArticle->getUrl();
            $arr['logo'] = $logo;

            $date = $newsArticle->getDate();
            if ($date !== null) {
                $arr['date'] = $date->getOffset() + $date->getTimestamp();
            } else {
                $arr['date'] = null;
            }

            $arrNewsArticle[$key] = $arr;
        }
        return $arrNewsArticle;
    }
}
//$ab = $newsArticle->getDate();
//print_r($ab->getOffset());
//print_r("\n");
//print_r($ab->format('Y-m-d H:i:s'));
//print_r("\n");
//print_r($ab->getTimestamp());
//print_r("\n");
//print_r(date('Y-m-d H:i:s', $ab->getTimestamp()));
//print_r("\n");
