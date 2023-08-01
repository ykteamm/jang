<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserProfilService
{

    public function userData($id)
    {
        $user = User::find($id);

        return $user;
    }
    public function productSold($id)
    {
        $medicines = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number) as number,tg_medicine.name, tg_medicine.image_url AS img')
            ->where('tg_productssold.user_id',$id)
            ->join('tg_medicine','tg_medicine.id','tg_productssold.medicine_id')
            ->orderBy('number','DESC')
            ->groupBy('tg_medicine.name', 'tg_medicine.image_url')
            ->limit(8)
            ->get();

        return $medicines;
    }
    public function historyLiga($id)
    {
        $month = 8;
        $ligas = [];
        for($i=$month;$i>0;$i--)
        {
            $date = date('Y-m-d',(strtotime ( '- '.($i*31).' day' , strtotime ( date('Y-m-d') ) ) ));
            $date_begin = $this->getFirstDate($date);
            $date_end = $this->getLastDate($date);

            $month = getMonths()[date('F',strtotime($date))];

            $new = new PlanServices;
            $liga = $new->getLiga($date_begin,$date_end,$id);
            $ligas[$month] = $liga;
        }

        return $ligas;
    }

    public function getFirstDate($date)
    {
        $d = Carbon::createFromFormat('Y-m-d', $date)
                        ->firstOfMonth()
                        ->format('Y-m-d');
        return $d;
    }

    public function getLastDate($date)
    {
        $d = Carbon::createFromFormat('Y-m-d', $date)
                        ->lastOfMonth()
                        ->format('Y-m-d');
        return $d;
    }
}
