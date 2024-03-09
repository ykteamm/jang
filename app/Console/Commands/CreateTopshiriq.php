<?php

namespace App\Console\Commands;

use App\Models\Topshiriq;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateTopshiriq extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'topshiriq:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Topshiriq yaratish va tahrirlash';

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
        $monday = date("Y-m-d", strtotime('monday this week'));
        $sunday = date("Y-m-d", strtotime('sunday this week'));
        $topshiriq = Topshiriq::where('status',1)->get();

        foreach ($topshiriq as $top){
            $update = Topshiriq::where('id',$top->id)->update([
               'status'=>0
            ]);
        }
        $lms = 'lms';
        $smena = 'smena';
        $savdo = 'savdo_300';
        $oltin_sut = 'oltin_sut';
        $suyak_komplex = 'suyak_komplex';
        $birga_bir = 'birga_bir';
        $kombo_sotuv = 'kombo_sotuv';
        $oraliq_test = 'oraliq_test';

//        DB::table('topshiriq')->insert([
//            'name'=>'LMSda 4 ta dars ko\'rish',
//            'description'=>'LMS ga kirib, 4 ta darsni ko\'rib testlarni ishlash',
//            'first_date'=>$monday,
//            'end_date'=>$sunday,
//            'number'=>4,
//            'star'=>22,
//            'status'=>1,
//            'key'=>$lms,
//            'created_at'=>now(),
//        ]);

        DB::table('topshiriq')->insert([
            'name'=>'50 ta oltin sut sotilsa, 150 ta cystall',
            'description'=>'1 hafta mobaynida 50 ta oltin sut sotilsa 150 ta crystall qo\'shib beriladi',
            'first_date'=>$monday,
            'end_date'=>$sunday,
            'number'=>50,
            'star'=>100,
            'status'=>1,
            'key'=>$oltin_sut,
            'crystall'=>150,
            'created_at'=>now(),
        ]);
        DB::table('topshiriq')->insert([
            'name'=>'12ta suyak komplex sotilsa 200 ta cystall beriladi',
            'description'=>'1 haftada 12ta suyak komplex sotilsa 200 ta crystall beriladi',
            'first_date'=>$monday,
            'end_date'=>$sunday,
            'number'=>12,
            'star'=>90,
            'crystall'=>200,
            'status'=>1,
            'key'=>$suyak_komplex,
            'created_at'=>now(),
        ]);
//        DB::table('topshiriq')->insert([
//            'name'=>'Birga bir jang oxirgi 3ta jangda 2ta g\'alaba qilish',
//            'description'=>'Oxirgi 3ta jangda 2ta g\'alaba qilish',
//            'first_date'=>$monday,
//            'end_date'=>$sunday,
//            'number'=>2,
//            'star'=>30,
////            'crystall'=>200,
//            'status'=>1,
//            'key'=>$birga_bir,
//            'created_at'=>now(),
//        ]);

//        DB::table('topshiriq')->insert([
//            'name'=>'LMSda oraliq testni ishlash',
//            'description'=>'Bu haftada oraliq testni ishlash',
//            'first_date'=>$monday,
//            'end_date'=>$sunday,
//            'number'=>1,
//            'star'=>30,
////            'crystall'=>200,
//            'status'=>1,
//            'key'=>$oraliq_test,
//            'created_at'=>now(),
//        ]);

//        DB::table('topshiriq')->insert([
//            'name'=>'Kombo Sotuv',
//            'description'=>'Bir haftadan 4marta kombo sotuv, Kombo Sotuv bu birinchi kunda qilgan savdosidan ikkinchi kun ko\'proq qilishdir',
//            'first_date'=>$monday,
//            'end_date'=>$sunday,
//            'number'=>4,
//            'star'=>30,
////            'crystall'=>200,
//            'status'=>1,
//            'key'=>$kombo_sotuv,
//            'created_at'=>now(),
//        ]);

        DB::table('topshiriq')->insert([
            'name'=>'1haftada 3kun 300 mingdan sotish',
            'description'=>'1 hafta davomida xohlagan 3 kunda 300 000 savdo qilish',
            'first_date'=>$monday,
            'end_date'=>$sunday,
            'number'=>3,
            'star'=>30,
//            'crystall'=>200,
            'status'=>1,
            'key'=>$savdo,
            'created_at'=>now(),
        ]);

        DB::table('topshiriq')->insert([
            'name'=>'Smena ochish soat 9:00 dan kechikmasdan',
            'description'=>'Ketma - ket 4kun 9:00dan oldin smena ochilsa 20ta yulduz beriladi',
            'first_date'=>$monday,
            'end_date'=>$sunday,
            'number'=>4,
            'star'=>20,
//            'crystall'=>200,
            'status'=>1,
            'key'=>$smena,
            'created_at'=>now(),
        ]);



    }
}
