<?php

namespace App\HandlerNewNews\HandlerArticles\Reconstruction;

class ReconstructionAfterLoad
{
    private object $objNewsArticle;

    public function __construct(object $objNewsArticle)
    {
        $this->objNewsArticle = $objNewsArticle;
    }

    public function reconstruct()
    {
//        foreach ($this->objNewsArticle as $value) {
////            print_r($value->date);
//            print_r($value);
//        }
        return $this->objNewsArticle;
//        print_r($this->objNewsArticle);
    }

}
