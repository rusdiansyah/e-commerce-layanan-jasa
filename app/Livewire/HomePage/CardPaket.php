<?php

namespace App\Livewire\HomePage;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CardPaket extends Component
{
    public $item;
    public function mount($item)
    {
        $this->item = $item;
    }
    public function render()
    {
        return view('livewire.home-page.card-paket');
    }
    public function booking($id)
    {
        dd(Auth::user());
    }
}
