<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\PlanServices;
use Illuminate\Console\Command;

class CreatePlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:plan';

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
    public function handle()
    {
        
            $users = User::whereIn('status',[1,2])->get();

            foreach ($users as $key => $value) {
                  $b = new PlanServices;
                  $bser = $b->createPlan($value->id);
            }

    }
}
