<?php

namespace App\Console\Commands;

use App\Services\NewsService;
use Illuminate\Console\Command;

class CreateNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'battle:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates news about weekly kingSolds and teamBattles result';

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
    public function handle()
    {
        try {
            $newsService = new NewsService;
            $newsService->king();
            $newsService->team();
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
}
