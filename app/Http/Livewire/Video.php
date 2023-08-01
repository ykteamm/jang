<?php

namespace App\Http\Livewire;

use App\Models\Video as ModelsVideo;
use Livewire\Component;

class Video extends Component
{
    public $videoIds = [];
    public $video = null;
    public $vidYid = "";

    public function mount()
    {
        $this->videoIds = ModelsVideo::where('publish', true)->orderBy('id', "DESC")->pluck('id');
    }

    protected $listeners = ['showVid' => 'showVideoMethod'];

    public function showVideoMethod($id)
    {
        try {
            $this->video = ModelsVideo::find($id);
            $this->vidYid = substr($this->video->url, 32);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.video');
    }
}
