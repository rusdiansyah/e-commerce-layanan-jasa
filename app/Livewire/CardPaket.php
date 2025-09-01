<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Paket;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Throwable;

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
        return view('livewire.card-paket');
    }
    public function edit($id)
    {
        return $this->redirectRoute('produk.paketEdit', $id);
    }
    public function cofirmDelete($id)
    {
        $this->dispatch('confirm', id: $id);
    }
    public function booking($id)
    {
        // dd($id);
        $booking = Booking::where('user_id',$this->user_id)
        ->where('paket_id',$id)
        ->where('status','Pending')
        ->first();
        if($booking)
        {
            return $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => 'Paket sudah dipilih',
                'icon' => 'warning',
            ]);

        }else{
            Booking::create([
                'user_id' => $this->user_id,
                'paket_id' => $id,
                'status' => 'Pending',
                'jml_orang' => 1,
            ]);
            return $this->dispatch('swal', [
                'title' => 'Success!',
                'text' => 'Paket berhasil disimpan',
                'icon' => 'success',
            ]);
        }
    }
}
