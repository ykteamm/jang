<?php

namespace App\Http\Livewire;

use App\Models\Info;
use App\Models\Video;
use Livewire\Component;

class InfoSection extends Component
{
    public $resime = 1;
    public $videos = 1;
    public $battleVideos = 1;
    public $infos = 1;
    protected $listeners = ['for_info' => 'info'];

    public function info()
    {
        $this->resime = 2;
        $this->videos = Video::where('publish', true)->where('category', 0)->orderBy('id', "DESC")->get();
        $this->battleVideos = Video::where('publish', true)->where('category', 1)->orderBy('id', "DESC")->get();
        $this->infos = Info::where('publish', true)->orderBy('id', "DESC")->get();
    }

    public function render()
    {
        return view('livewire.info-section');
    }
}
