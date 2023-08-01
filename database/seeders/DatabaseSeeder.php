<?php

namespace Database\Seeders;

use App\Models\Shift;
use App\Models\TurnirGroup;
use App\Models\TurnirMember;
use App\Models\TurnirPoint;
use App\Models\TurnirTeam;
use App\Models\TurnirTeamGroup;
use App\Models\TurnirTour;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TurnirPlayoffSeeder::class
        ]);
        // $users = User::all();

        // $Variable1 = strtotime('2023-05-01');
        // $Variable2 = strtotime('2023-05-31');
        // $array = [];
        // foreach ($users as $key => $value) {
        //     for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400)) {
        //         $shift = Shift::where('user_id',$value->id)->whereDate('created_at',date('Y-m-d',$currentDate))->first();
        //         if($shift)
        //         {
        //             $check = json_decode($shift->admin_check);
        //             if($check != null)
        //             {
        //                 if($check->check == 'ok')
        //                 {
        //                     $del = DB::table('tg_details')->where('user_id',$value->id)->where('status',2)
        //                     ->whereDate('created_at',date('Y-m-d',$currentDate))->delete();
        //                 }
        //             }
        //         }
        //     }
        // }

        // $groups = ['A', 'B', 'C', 'D'];

        // foreach ($groups as $gr) {
        //     $group = new TurnirGroup;
        //     $group->name = $gr;
        //     $group->save();
        // }

        // for ($i = 1; $i <= 16; $i++) {
        //     $team = new TurnirTeam();
        //     $team->name = $i . '-jamoa';
        //     $team->save();
        // }

        // $turnirGroups = TurnirGroup::orderBy('id', 'ASC')->get();
        // $turnirTeams = TurnirTeam::orderBy('id', 'ASC')->get();
        // TurnirTour::create([
        //     'tour' => 1,
        //     'date_begin' => '2023-06-10',
        //     'date_end' => '2023-06-12',
        //     'month' => '2023-06-01'
        // ]);
        // TurnirTour::create([
        //     'tour' => 2,
        //     'date_begin' => '2023-06-13',
        //     'date_end' => '2023-06-14',
        //     'month' => '2023-06-01'
        // ]);
        // TurnirTour::create([
        //     'tour' => 3,
        //     'date_begin' => '2023-06-15',
        //     'date_end' => '2023-06-16',
        //     'month' => '2023-06-01'
        // ]);
        // TurnirTour::create([
        //     'tour' => 4,
        //     'date_begin' => '2023-06-17',
        //     'date_end' => '2023-06-20',
        //     'month' => '2023-06-01'
        // ]);
        // TurnirTour::create([
        //     'tour' => 5,
        //     'date_begin' => '2023-06-21',
        //     'date_end' => '2023-06-23',
        //     'month' => '2023-06-01'
        // ]);
        // TurnirTour::create([
        //     'tour' => 6,
        //     'date_begin' => '2023-06-24',
        //     'date_end' => '2023-06-27',
        //     'month' => '2023-06-01'
        // ]);
        
        // $i = 1;
        // foreach ($turnirTeams as $t) {
        //     $groupId = $turnirGroups[0]->id;
        //     if($i >= 5 && $i <= 8) {
        //         $groupId = $turnirGroups[1]->id;
        //     } else if ($i >= 9 && $i <= 12) {
        //         $groupId = $turnirGroups[2]->id;
        //     } else if ($i >= 13) {
        //         $groupId = $turnirGroups[3]->id;
        //     }
        //     $teamGroup = new TurnirTeamGroup();
        //     $teamGroup->team_id = $t->id;
        //     $teamGroup->group_id = $groupId;
        //     $teamGroup->month = '2023-06-01';
        //     $teamGroup->save();
        //     $i++;
        // }

        // $teams = [
        //     [229, 279],
        //     [50, 317],
        //     [177, 315],
        //     [54, 96],
        //     [33, 244],
        //     [67, 10],
        //     [64, 311],
        //     [286, 269],
        //     [79, 314],
        //     [5, 228],
        //     [235, 303],
        //     [92, 306],
        //     [108, 86],
        //     [232, 295],
        //     [255, 157],
        //     [29, 307]
        // ];
        // $i = 1;
        // foreach ($turnirTeams as $t) {
        //     for ($j = 1; $j <= 3; $j++) {
        //         TurnirPoint::create([
        //             'point' => 0,
        //             'team_id' => $t->id,
        //             'tour' => $j,
        //             'month' => '2023-06-01'
        //         ]);
        //     }
        //     $i++;
        // }
        // $i = 1;
        // foreach ($turnirTeams as $t) {
        //     $team = $teams[$i - 1];
        //     for ($s = 1; $s <= 2; $s++) {
        //         $member = $team[$s - 1];
        //         for ($j = 1; $j <= 3; $j++) {
        //             TurnirMember::create([
        //                 'team_id' => $t->id,
        //                 'user_id' => $member,
        //                 'tour' => $j,
        //                 'month' => '2023-06-01'
        //             ]);
        //         }
        //     }
        //     $i++;
        // }

        // $array = ['Antigelmint Flakon','Solegon Flakon'];
        // $array2 = [51400,48900];

        // foreach($array as $key => $val)
        // {
        //     $group = DB::table('tg_medicine')->insert([
        //         'name' => $val,
        //         'code' => 'P0'.$key+61,
        //         'price' => $array2[$key],
        //         'sort' => 63,
        //         'created_at' => date('Y-m-d'),
        //         'category_id' => 2,
        //         'old_price' => 0,
        //         'shablon_id' => 1,
        //     ]);

        //     $ids = DB::table('tg_medicine')->orderBy('id','DESC')->first();

        //     $er = DB::table('tg_prices')->insert([
        //         'price' => $array2[$key],
        //         'medicine_id' => $ids->id,
        //         'shablon_id' => 3,
        //         'created_at' => date('Y-m-d'),
        //         'updated_at' => date('Y-m-d'),
        //     ]);
        // }
    }
}
