<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NewsButton extends Component
{
    public $notifcount;
    public function mount()
    {
        $this->notifcount = auth()->user()->unreadNotifications()->count();
    }

    public function render()
    {
        return view('livewire.news-button');
    }
}
