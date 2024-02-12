<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Price;
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
        // $this->call([
        //     TopshiriqSeeder::class,
        //     TopshiriqLevelSeeder::class,
        // ]);



        // $medicine = new Medicine;
        // $medicine->name = 'Suyak kompleksi';
        // $medicine->code = 'P075';
        // $medicine->price = 1;
        // $medicine->sort = 72;
        // $medicine->created_at = date('Y-m-d H:i:s');
        // $medicine->category_id = 4;
        // $medicine->save();

        // $medicine = DB::table('tg_medicine')->insertGetId([
        //     'name' => 'Suyak kompleksi',
        //     'code' => 'P075',
        //     'price' => 1,
        //     'sort' => 72,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'category_id' => 4
        // ]);

        // $array_suyak = [
        //     1 => 192800,
        //     3 => 271400,
        //     5 => 271400,
        //     6 => 281700,
        // ];

        // foreach ($array_suyak as $key => $val){
        //     $price = new Price;
        //     $price->price = $val;
        //     $price->medicine_id = $medicine;
        //     $price->shablon_id = $key;
        //     $price->save();
        // }


        // DB::table('lms_group_tests')->where('ball','<',100)->update([
        //     'ball' => 90,
        //     'limit' => 2,
        // ]);


    }
}
