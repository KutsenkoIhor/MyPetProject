<?php

namespace App\HandlerNewNews\HandlerArticles\Reconstruction;

class Reconstruction
{
    private array $arrNewsArticle;

    public function __construct(array $arrNewsArticle)
    {
        $this->arrNewsArticle = $arrNewsArticle;
    }

    public function reconstruct(): array
    {
        self::handlerDate();
        return $this->arrNewsArticle;
    }

    private function handlerDate(): void
    {
        foreach ($this->arrNewsArticle as &$value) {
            $value['date'] = date('Y-m-d H:i:s', $value['date']);
        }
    }
}
