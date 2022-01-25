<?php

namespace App\Jobs;

use App\HandlerNewNews\HandlerArticles\LoaderUnloaderArticles\LoaderArticles;
use App\HandlerNewNews\HandlerArticles\Reconstruction\ReconstructionBeforeLoad;
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
        $objNewsArticle = $objParser->dissection();

        $objReconstruction = new ReconstructionBeforeLoad ($objNewsArticle);
        $arrUpdateNewsArticle = $objReconstruction->startReconstruction();

        LoaderArticles::startLoad($arrUpdateNewsArticle);
    }
}
