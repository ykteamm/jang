<?php

namespace Database\Seeders;

use App\Models\Topshiriq;
use App\Models\TopshiriqLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopshiriqLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TopshiriqLevel::truncate();
        DB::table('topshiriq_level')->insert([
            'daraja'=>1,
            'name'=>'1_daraja',
            'number_star'=>400,
            'created_at'=>now(),
        ]);
        DB::table('topshiriq_level')->insert([
            'daraja'=>2,
            'name'=>'2_daraja',
            'number_star'=>500,
            'created_at'=>now(),
        ]);
        DB::table('topshiriq_level')->insert([
            'daraja'=>3,
            'name'=>'3_daraja',
            'number_star'=>600,
            'created_at'=>now(),
        ]);
        DB::table('topshiriq_level')->insert([
            'daraja'=>4,
            'name'=>'4_daraja',
            'number_star'=>700,
            'created_at'=>now(),
        ]);
        DB::table('topshiriq_level')->insert([
            'daraja'=>5,
            'name'=>'5_daraja',
            'number_star'=>800,
            'created_at'=>now(),
        ]);
        DB::table('topshiriq_level')->insert([
            'daraja'=>6,
            'name'=>'6_daraja',
            'number_star'=>900,
            'created_at'=>now(),
        ]);
    }
}
