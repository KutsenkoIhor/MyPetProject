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
    }
}
