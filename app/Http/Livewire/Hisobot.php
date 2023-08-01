<?php

namespace App\Http\Livewire;

use App\Models\AllSold;
use App\Models\DailyWork;
use App\Services\HelperServices;
use App\Services\WorkDayServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Hisobot extends Component
{
    public $start_date;
    public $end_date;
    public $date = 'Bugun';
    public $hisobot;
    public $medicine;
    public $allprice;
    public $start_work;
    public $finish_work;
    public $resime = 1;

    protected $listeners = ['last30' => 'last30A','for_hisobot' => 'hisobot'];

    public function hisobot()
    {
        $this->resime = 2;
        $this->executer($this->date);
    }
    public function last30A($d)
    {
        $this->start_date = null;
        $this->end_date = null;
        $this->executer($d);
    }

    public function submit()
    {
        $this->executer($this->start_date, $this->end_date);
    }

    public function executer($start = null, $end = null)
    {
        $timeServices = new HelperServices;
        $time = $timeServices->day($start, $end);
        $date_begin = $time->date_begin;
        $date_end = $time->date_end;
        $this->date = $time->dateText;
        $this->hisobot = $timeServices->hisobot($date_begin,$date_end);
        $this->medicine = $timeServices->medicine($date_begin,$date_end);
        $this->allprice = $timeServices->allprice($date_begin,$date_end);

        // $works = new WorkDayServices;

    }

    public function render()
    {
        $work_time = DailyWork::where('user_id',userme()->id)->where('active',1  )->get();

        if(count($work_time) > 0)
        {
            $this->start_work = $work_time[0]->start_work;
            $this->finish_work = $work_time[0]->finish_work;
        }

        return view('livewire.hisobot');
    }
}
