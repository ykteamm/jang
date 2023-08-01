<?php

namespace App\Console\Commands;

use App\Models\TurnirStanding;
use App\Services\TurnirService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TurnirPlayoff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'turnir:playoff';

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
        $service = new TurnirService;
        if ($service->tour->tour == 5) {
            $this->semiFinal();
        } else if ($service->tour->tour == 6) {
            $this->final();
        }
    }

    public function semiFinal()
    {
        $fv = 5;
        $sx = 6;
        $service = new TurnirService;
        $five = DB::table('turnir_playoffs')
            ->where('to', $fv)
            ->whereDate('month', $service->month)
            ->orderBy('node', 'ASC')
            ->get();

        $six = DB::table('turnir_playoffs')
            ->where('to', $sx)
            ->whereDate('month', $service->month)
            ->orderBy('node', 'ASC')
            ->get();

        $fiveBattle1 = TurnirStanding::find($five[0]->battle_id);
        $fiveBattle2 = TurnirStanding::find($five[1]->battle_id);
        $sixBattle1 = TurnirStanding::find($six[0]->battle_id);
        $sixBattle2 = TurnirStanding::find($six[1]->battle_id);

        $battleFiveNode = TurnirStanding::create([
            'team1_id' => $fiveBattle1->win,
            'team2_id' => $fiveBattle2->win,
            'win' => null,
            'lose' => null,
            'tour' => $service->tour->tour,
            'date_begin' => $service->tour->date_begin,
            'date_end' => $service->tour->date_end,
            'status' => 1,
            'month' => $service->month,
            'ends' => 0,
        ]);
        $battleSixNode = TurnirStanding::create([
            'team1_id' => $sixBattle1->win,
            'team2_id' => $sixBattle2->win,
            'win' => null,
            'lose' => null,
            'tour' => $service->tour->tour,
            'date_begin' => $service->tour->date_begin,
            'date_end' => $service->tour->date_end,
            'status' => 1,
            'month' => $service->month,
            'ends' => 0,
        ]);
        TurnirPlayoff::where('node', $fv)
            ->whereDate('month', $service->month)
            ->update([
                'battle_id' => $battleFiveNode->id
            ]);
        TurnirPlayoff::where('node', $sx)
            ->whereDate('month', $service->month)
            ->update([
                'battle_id' => $battleSixNode->id
            ]);
    }

    public function final()
    {
        $service = new TurnirService;
        $sv = 7;
        $seven = DB::table('turnir_playoffs')
            ->where('to', $sv)
            ->whereDate('month', $service->month)
            ->orderBy('node', 'ASC')
            ->get();

        $sevenBattle1 = TurnirStanding::find($seven[0]->battle_id);
        $sevenBattle2 = TurnirStanding::find($seven[1]->battle_id);

        $battleFinalNode = TurnirStanding::create([
            'team1_id' => $sevenBattle1->win,
            'team2_id' => $sevenBattle2->win,
            'win' => null,
            'lose' => null,
            'tour' => $service->tour->tour,
            'date_begin' => $service->tour->date_begin,
            'date_end' => $service->tour->date_end,
            'status' => 1,
            'month' => $service->month,
            'ends' => 0,
        ]);
        TurnirPlayoff::where('node', $sv)
            ->whereDate('month', $service->month)
            ->update([
                'battle_id' => $battleFinalNode->id
            ]);
    }
}
