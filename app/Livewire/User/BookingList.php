<?php

namespace App\Livewire\User;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;
class BookingList extends Component
{
    use WithPagination;
    #[Title('Booking')]
    public $title = 'Booking';
    public $paginate = 10;
    public $search;
    public function mount()
    {
        $this->title;
    }
    public function render()
    {
        $data = Booking::when($this->search, function ($q) {
            $q->whereHas('paket', function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%');
            });
        })
        ->where('user_id',Auth::user()->id)
            ->paginate($this->paginate);
        return view('livewire.user.booking-list',[
            'data' => $data
        ]);
    }
    public function udaptedSearch()
    {
        $this->resetPage();
    }
    public function payment($id)
    {
        return $this->redirectRoute('user.bookingPayment', $id);
    }
    public function cofirmDelete($id)
    {
        $this->dispatch('confirm', id: $id);
    }
    #[On('delete')]
    public function delete($id)
    {
        try {
            Booking::find($id)->delete();
            $this->dispatch('update-notifikasi');
            $this->dispatch('swal', [
                'title' => 'Success!',
                'text' => 'Data berhasil dihapus',
                'icon' => 'success',
            ]);
        } catch (Throwable $e) {
            report($e);
            $this->dispatch('swal', [
                'title' => 'Error!',
                'text' => 'Data tidak dapat dihapus',
                'icon' => 'Error',
            ]);
            return false;
        }
    }
}
