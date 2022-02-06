<?php

namespace App\HandlerNewNews\HandlerArticles\Reconstruction;

class ReconstructionAfterLoad
{
    private object $objNewsArticle;

    public function __construct(object $objNewsArticle)
    {
        $this->objNewsArticle = $objNewsArticle;
    }

    public function reconstruct(): object
    {
        return $this->objNewsArticle;
    }
}
