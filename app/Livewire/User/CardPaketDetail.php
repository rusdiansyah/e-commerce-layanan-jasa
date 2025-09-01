<?php

namespace App\Livewire\User;

use App\Models\Booking;
use App\Models\Paket;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class CardPaketDetail extends Component
{
    #[Title('Paket Detail')]
    public $title = 'Paket Detail';
    public $id,$user_id;
    public function mount($id)
    {
        $this->title;
        $this->id = $id;
        $this->user_id = Auth::user()->id;
    }
    public function render()
    {
        $data = Paket::where('id', $this->id)->first();
        return view('livewire.user.card-paket-detail',[
            'data' => $data
        ]);
    }
    public function booking($id)
    {
        // dd($id);
        $booking = Booking::where('user_id', $this->user_id)
            ->where('paket_id', $id)
            ->where('status', 'Pending')
            ->first();
        if ($booking) {
            return $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => 'Paket sudah dipilih',
                'icon' => 'warning',
            ]);
        } else {
            Booking::create([
                'user_id' => $this->user_id,
                'paket_id' => $id,
                'status' => 'Pending',
                'jml_orang' => 1,
            ]);
            $this->dispatch('update-notifikasi');
            return $this->dispatch('swal', [
                'title' => 'Success!',
                'text' => 'Paket berhasil disimpan',
                'icon' => 'success',
            ]);
        }
    }
}
