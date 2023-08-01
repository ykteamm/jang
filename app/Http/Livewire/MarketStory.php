<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MarketStory extends Component
{

    public $categories;
    public $sliders;

    protected $listeners = ['change_Slider' => 'changeSlider'];

    public function mount()
    {
        $this->categories = DB::table('market_slider_categories')->orderBy('id','ASC')->get();


        $first = DB::table('market_slider_categories')->orderBy('id','ASC')->first();

        if($first)
        {
            $this->sliders = DB::table('market_sliders')->where('category_id',$first->id)->get();
        }
    }

    public function changeSlider($id)
    {
        $this->sliders = DB::table('market_sliders')->where('category_id',intval($id))->get();
        $this->categories = DB::table('market_slider_categories')->orderBy('id','ASC')->get();

    }

    public function render()
    {
        return view('livewire.market-story');
    }
}
