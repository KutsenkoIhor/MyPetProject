<?php

namespace App\Console\Commands;

use App\HandlerNewNews\InitializeQueue\InitializeQueue;
use Illuminate\Console\Command;

class CreateNewsTaskScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:newsTaskScheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        InitializeQueue::start();
        return 0;
    }
}
