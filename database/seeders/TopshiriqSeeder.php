<?php

namespace Database\Seeders;

use App\Models\Topshiriq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopshiriqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topshiriq::truncate();
        DB::table('topshiriq')->insert([
            'name'=>'LMSda 5ta dars ko\'rish',
            'description'=>'LMS ga kirib, 5ta darsni ko\'rib testlarni ishlash',
            'first_date'=>'2024-02-13',
            'end_date'=>'2024-02-17',
            'number'=>5,
            'star'=>20,
            'status'=>1,
            'key'=>'lms',
            'created_at'=>now(),
        ]);
        DB::table('topshiriq')->insert([
            'name'=>'Smena ochish soat 9:00 dan kechikmasdan',
            'description'=>'Ketma - ket 4kun 9:00dan oldin smena ochilsa 20ta yulduz beriladi',
            'first_date'=>'2024-02-13',
            'end_date'=>'2024-02-17',
            'number'=>4,
            'star'=>10,
            'status'=>1,
            'key'=>'smena',
            'created_at'=>now(),
        ]);
       DB::table('topshiriq')->insert([
            'name'=>'1haftada 3kun 300 mingdan sotish',
            'description'=>'1 hafta davomida xohlagan 3 kunda 300 000 savdo qilish',
            'first_date'=>'2024-02-13',
            'end_date'=>'2024-02-17',
            'number'=>3,
            'star'=>30,
            'status'=>1,
            'key'=>'savdo_300',
            'created_at'=>now(),
        ]);
        DB::table('topshiriq')->insert([
            'name'=>'10ta oltin sut sotilsa, 100ta cystall',
            'description'=>'1 hafta mobaynida 10ta oltin sut sotilsa 100ta crystall qo\'shib beriladi',
            'first_date'=>'2024-02-13',
            'end_date'=>'2024-02-17',
            'number'=>10,
            'star'=>30,
            'status'=>1,
            'key'=>'oltin_sut',
            'crystall'=>100,
            'created_at'=>now(),
        ]);
        DB::table('topshiriq')->insert([
            'name'=>'10ta suyak komplex sotilsa 100ta cystall beriladi',
            'description'=>'1 haftada 10ta suyak komplex sotilsa 100ta crystall beriladi',
            'first_date'=>'2024-02-13',
            'end_date'=>'2024-02-17',
            'number'=>10,
            'star'=>30,
            'crystall'=>100,
            'status'=>1,
            'key'=>'suyak_komplex',
            'created_at'=>now(),
        ]);

    }
}
