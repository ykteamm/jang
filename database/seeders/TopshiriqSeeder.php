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
            'name'=>'LMSda 5 ta dars ko\'rish',
            'description'=>'LMS ga kirib, 5 ta darsni ko\'rib testlarni ishlash',
            'first_date'=>'2024-02-13',
            'end_date'=>'2024-02-17',
            'number'=>5,
            'star'=>22,
            'status'=>1,
            'key'=>'lms',
            'created_at'=>now(),
        ]);
        DB::table('topshiriq')->insert([
            'name'=>'Smena ochish soat 9:00 dan kechikmasdan',
            'description'=>'Ketma - ket 4 kun 9:00dan oldin smena ochilsa 20ta yulduz beriladi',
            'first_date'=>'2024-02-13',
            'end_date'=>'2024-02-17',
            'number'=>4,
            'star'=>10,
            'status'=>1,
            'key'=>'smena',
            'created_at'=>now(),
        ]);
       DB::table('topshiriq')->insert([
            'name'=>'1haftada 4 kun 300 mingdan sotish',
            'description'=>'1 hafta davomida ixtiyoriy 4 kunda 300 000 dan savdo qilish',
            'first_date'=>'2024-02-13',
            'end_date'=>'2024-02-17',
            'number'=>4,
            'star'=>25,
            'status'=>1,
            'key'=>'savdo_300',
            'created_at'=>now(),
        ]);
        DB::table('topshiriq')->insert([
            'name'=>'50 ta oltin sut sotilsa, 150 ta cystall',
            'description'=>'1 hafta mobaynida 50 ta oltin sut sotilsa 150 ta crystall qo\'shib beriladi',
            'first_date'=>'2024-02-13',
            'end_date'=>'2024-02-17',
            'number'=>50,
            'star'=>100,
            'status'=>1,
            'key'=>'oltin_sut',
            'crystall'=>150,
            'created_at'=>now(),
        ]);
        DB::table('topshiriq')->insert([
            'name'=>'12ta suyak komplex sotilsa 200 ta cystall beriladi',
            'description'=>'1 haftada 12ta suyak komplex sotilsa 200 ta crystall beriladi',
            'first_date'=>'2024-02-13',
            'end_date'=>'2024-02-17',
            'number'=>12,
            'star'=>90,
            'crystall'=>200,
            'status'=>1,
            'key'=>'suyak_komplex',
            'created_at'=>now(),
        ]);

    }
}
