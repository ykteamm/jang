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
        $saturday = date("Y-m-d", strtotime('saturday this week'));
        $topshiriq = Topshiriq::where('status',1)->get();

        foreach ($topshiriq as $top){
            $update = Topshiriq::where('id',$top->id)->update([
               'status'=>0
            ]);
        }
        $lms = 'lms';
//        $smena = 'smena';
//        $savdo = 'savdo_300';
        $oltin_sut = 'oltin_sut';
        $suyak_komplex = 'suyak_komplex';
        $birga_bir = 'birga_bir';

        DB::table('topshiriq')->insert([
            'name'=>'LMSda 4 ta dars ko\'rish',
            'description'=>'LMS ga kirib, 4 ta darsni ko\'rib testlarni ishlash',
            'first_date'=>$monday,
            'end_date'=>$saturday,
            'number'=>4,
            'star'=>22,
            'status'=>1,
            'key'=>$lms,
            'created_at'=>now(),
        ]);

        DB::table('topshiriq')->insert([
            'name'=>'50 ta oltin sut sotilsa, 150 ta cystall',
            'description'=>'1 hafta mobaynida 50 ta oltin sut sotilsa 150 ta crystall qo\'shib beriladi',
            'first_date'=>$monday,
            'end_date'=>$saturday,
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
            'end_date'=>$saturday,
            'number'=>12,
            'star'=>90,
            'crystall'=>200,
            'status'=>1,
            'key'=>$suyak_komplex,
            'created_at'=>now(),
        ]);
        DB::table('topshiriq')->insert([
            'name'=>'Birga bir jang oxirgi 3ta jangda 2ta g\'alaba qilish',
            'description'=>'Oxirgi 3ta jangda 2ta g\'alaba qilish',
            'first_date'=>$monday,
            'end_date'=>$saturday,
            'number'=>2,
            'star'=>30,
//            'crystall'=>200,
            'status'=>1,
            'key'=>$birga_bir,
            'created_at'=>now(),
        ]);



    }
}
