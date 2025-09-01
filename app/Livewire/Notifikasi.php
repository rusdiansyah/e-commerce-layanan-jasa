<?php

namespace App\Livewire;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Notifikasi extends Component
{
    public $notifikasi;
    #[On('update-notifikasi')]
    public function mount()
    {
        $this->notifikasi =  Booking::where('user_id',Auth::user()->id)
        ->where('status','Pending')
        ->get();
    }
    public function render()
    {
        return view('livewire.notifikasi');
    }
}
