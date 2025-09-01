<?php

namespace App\Livewire\User;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CardPaket extends Component
{
    public $item;
    public $user_id;

    public function mount($item)
    {
        $this->item = $item;
        $this->user_id = Auth::user()->id;
    }
    public function render()
    {
        return view('livewire.user.card-paket');
    }


}
