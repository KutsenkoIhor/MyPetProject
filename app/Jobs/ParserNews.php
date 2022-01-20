<?php

namespace App\Jobs;

use App\HandlerNewNews\HandlerArticles\LoaderArticles\Loader;
use App\HandlerNewNews\HandlerArticles\Reconstruction\Reconstruction;
use App\HandlerNewNews\Parser\Parser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParserNews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $objParser = new Parser($this->url);
        $arrNewsArticle = $objParser->dissection();

        $objReconstruction = new Reconstruction($arrNewsArticle);
        $arrUpdateNewsArticle = $objReconstruction->reconstruct();

//        $objLoader = new Loader($arrUpdateNewsArticle);
//        $objLoader->load();

        Loader::startLoad($arrUpdateNewsArticle);
    }
}
