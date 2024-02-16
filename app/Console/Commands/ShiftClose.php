<?php

namespace App\Console\Commands;

use App\Models\AllSold;
use Illuminate\Console\Command;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShiftClose extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shift:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Smenani avtomatik yopish';

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
        $new = Shift::where('active', 1)->get();
        foreach ($new as $key => $value) {
            $table = AllSold::where('user_id', $value->user_id)->whereDate('created_at', $value->created_at)->orderByDesc('id')->value('created_at');
            if ($table == null) {
                $d = $value->open_date;
            } else {
                $d = date('Y-m-d H:i:s', strtotime($table));
            }
            $new = Shift::where('id', $value->id)->update([
                'close_date' => $d,
                'close_image' => NULL,
                'close_code' => '300',
                'active' => 2,
            ]);
            DB::table('tg_details')->insert([
                'price' => 20000,
                'status' => 2,
                'message' => date("Y-m-d")."da smenani vaqtida yopmaganligi uchun",
                'admin_id' => 37,
                'user_id' => $value->user_id,
                'is_active' => true,
                'created_at' => now()
              ]);
        }

        $new = Shift::whereNull('close_date')->get();
        foreach ($new as $key => $value) {
            $table = AllSold::where('user_id', $value->user_id)->whereDate('created_at', $value->created_at)->orderByDesc('id')->value('created_at');
            if ($table == null) {
                $d = $value->open_date;
            } else {
                $d = date('Y-m-d H:i:s', strtotime($table));
            }
            $new = Shift::where('id', $value->id)->update([
                'close_date' => $d,
                'close_image' => NULL,
                'close_code' => '300',
                'active' => 2,
            ]);
        }

        // $jjj = Shift::where('close_code',300)->whereDate('created_at','>=','2023-03-15')->orderBy('id','ASC')->get();
        // foreach ($jjj as $key => $value) {
        //     $table = AllSold::where('user_id',$value->user_id)->whereDate('created_at',$value->created_at)->orderByDesc('id')->value('created_at');
        //     $e = date('Y-m-d H:i:s',strtotime($table));
        //     $new = Shift::where('id',$value->id)->update([
        //                 'close_date' => $e,
        //     ]);
        // }
    }
}
