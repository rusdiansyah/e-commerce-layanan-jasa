<?php

namespace App\Livewire\User;

use App\Models\Booking;
use App\Models\InfoUser;
use App\Models\Pembayaran;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class BookingPayment extends Component
{
    use WithFileUploads;
    #[Title('Pembayaran')]
    public $title = 'Pembayaran';
    public $booking_id, $paket_id, $user_id, $jenis_paket, $nama_paket, $lama, $tanggal, $gambar;
    public $harga, $jml_orang, $subTotal;
    public $nik, $no_hp, $alamat, $buktiBayar;
    public function mount($id)
    {
        $this->title;
        $this->user_id = Auth::user()->id;
        $this->booking_id = $id;
        $data = Booking::where('user_id', $this->user_id)
            ->where('id', $id)
            ->first();
        if ($data) {
            $infoUser = InfoUser::where('user_id', $this->user_id)->first();

            $this->jenis_paket = $data->paket->jenis->nama;
            $this->paket_id = $data->paket_id;
            $this->nama_paket = $data->paket->nama;
            $this->gambar = $data->paket->gambar;
            $this->harga = $data->paket->harga;
            $this->lama = $data->paket->lama;
            $this->tanggal = Carbon::parse($data->paket->tgl_mulai)->format('d-m-Y') . ' s.d ' . Carbon::parse($data->paket->tgl_selesai)->format('d-m-Y');
            $this->jml_orang = $data->jml_orang;
            $this->subTotal = $data->paket->harga * $data->jml_orang;

            $this->nik = $infoUser->nik ?? '';
            $this->no_hp = $infoUser->no_hp ?? '';
            $this->alamat = $infoUser->alamat ?? '';
            $this->buktiBayar = '';
        } else {
            return $this->redirectRoute('user.paketList');
        }
    }
    public function render()
    {
        return view('livewire.user.booking-payment');
    }
    public function kurang($id)
    {
        $booking = Booking::where('user_id', $this->user_id)
            ->where('paket_id', $id)
            ->where('status', 'Pending')
            ->first();
        if ($booking->jml_orang == 1) {
            return false;
        }
        $this->subTotal = ($booking->jml_orang - 1) * $this->harga;
        $this->jml_orang = ($booking->jml_orang - 1);
        $booking->jml_orang = (int) $booking->jml_orang - 1;
        $booking->save();
    }
    public function tambah($id)
    {
        $booking = Booking::where('user_id', $this->user_id)
            ->where('paket_id', $id)
            ->where('status', 'Pending')
            ->first();
        $this->subTotal = ($booking->jml_orang + 1) * $this->harga;
        $this->jml_orang = ($booking->jml_orang + 1);
        $booking->jml_orang = (int) $booking->jml_orang + 1;
        $booking->save();
    }
    public function handleUpload()
    {
        $this->validate([
            'nik' => 'required|numeric|min:15',
            'no_hp' => 'required|min:5',
            'alamat' => 'required|min:5',
            'buktiBayar' => 'required|image|max:2084',
        ]);
        $path = $this->buktiBayar->store('bukti_bayar', 'public');
        Pembayaran::updateOrCreate(['booking_id' => $this->booking_id], [
            'booking_id' => $this->booking_id,
            'metode' => 'Bank Transfer',
            'status' => 'Pending',
            'total' => $this->subTotal,
            'bukti' => $path,
        ]);
        Booking::where('id', $this->booking_id)
            ->where('user_id', $this->user_id)
            ->update([
                'status' => 'Confirmed',
                'jml_orang' => $this->jml_orang,
            ]);
        InfoUser::updateOrCreate(['user_id' => $this->user_id], [
            'nik' => $this->nik,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
        ]);
        $this->dispatch('swal', [
            'title' => 'Success!',
            'text' => 'Data berhasil dihapus',
            'icon' => 'success',
        ]);
        return $this->redirectRoute('user.bookingList');
    }
}
