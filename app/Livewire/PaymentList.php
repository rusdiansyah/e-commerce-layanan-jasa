<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Pembayaran;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentList extends Component
{
    use WithPagination;
    #[Title('Pembayaran')]
    public $title = 'Pembayaran';
    public $id, $booking_id, $metode, $total, $status, $bukti;
    public $user, $jml_orang, $statusBooking, $nik, $nohp, $alamat;
    public $nama_paket, $gambar, $harga_paket;
    public $postAdd = false;
    public $isStatus;
    public $paginate = 10;
    public $search;
    public function mount()
    {
        $this->title;
        $this->isStatus = 'create';
    }
    public function render()
    {
        $data = Pembayaran::whereAny(['metode', 'status'], 'like', '%' . $this->search . '%')
            ->paginate($this->paginate);
        return view('livewire.payment-list', [
            'data' => $data
        ]);
    }
    public function close()
    {
        $this->postAdd = false;
    }
    public function edit($id)
    {
        $this->postAdd = true;
        $this->isStatus = 'Edit';
        $data = Pembayaran::findOrFail($id);
        $this->id = $data->id;
        $this->booking_id = $data->booking_id;
        $this->metode = $data->metode;
        $this->status = $data->status;
        $this->bukti = $data->bukti;
        $this->user = $data->booking->user->name;
        $this->nik = $data->booking->user->info->nik ?? '';
        $this->nohp = $data->booking->user->info->no_hp ?? '';
        $this->alamat = $data->booking->user->info->alamat ?? '';
        $this->jml_orang = $data->booking->jml_orang;
        $this->statusBooking = $data->booking->status;
        $this->nama_paket = $data->booking->paket->nama;
        $this->gambar = $data->booking->paket->gambar;
        $this->harga_paket = number_format($data->booking->paket->harga);
        $this->total = number_format($data->total);
    }
    #[Computed]
    public function listStatus()
    {
        return [
            'Pending',
            'Paid',
            'Failed',
        ];
    }
    public function save()
    {
        $this->validate([
            'status' => 'required',
        ]);
        if ($this->status == 'Pending') {
            $this->statusBooking = 'Confirmed';
        } elseif ($this->status == 'Paid') {
            $this->statusBooking = 'Completed';
        } elseif ($this->status == 'Failed') {
            $this->statusBooking = 'Cancelled';
        }
        Booking::where('id', $this->booking_id)
            ->update([
                'status' => $this->statusBooking,
            ]);
        Pembayaran::where('id', $this->id)
            ->update([
                'status' => $this->status,
            ]);
        $this->dispatch('swal', [
            'title' => 'Success!',
            'text' => 'Data berhasil disimpan',
            'icon' => 'success',
        ]);
        $this->dispatch('close-modal');
    }
}
