<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\Client;
use App\Models\Message;
use Livewire\Component;

class Mijoz extends Component
{
    public $clients;
    public $messages;
    public $link;

    public function mount()
    {
        $this->clients = Client::all();

        $host = substr(request()->getHttpHost(),0,3);
        if($host == '127')
        {
            $link = 'http://127.0.0.1:8080/mijoz/message';
        }else{
            $link = 'https://mijoz.novatio.uz/mijoz/message';
        }
        $this->link = $link;
    }



    public function selectPatient($client_id)
    {
        $chat = Chat::where('client_id',$client_id)->first();
        $this->messages = Message::where('chat_id',$chat->id)->where('client_id',$client_id)->get();
    }

    public function render()
    {
        return view('livewire.mijoz');
    }
}
