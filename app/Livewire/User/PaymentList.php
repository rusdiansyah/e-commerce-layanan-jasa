<?php

namespace App\Livewire\User;

use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentList extends Component
{
    use WithPagination;
    #[Title('Pembayaran')]
    public $title = 'Pembayaran';
    public $paginate = 10;
    public $search;
    public function mount()
    {
        $this->title;
    }
    public function render()
    {
        $data = Pembayaran::whereAny(['metode', 'status'], 'like', '%' . $this->search . '%')
            ->whereHas('booking', function ($q) {
                return $q->where('user_id', Auth::user()->id);
            })
            ->paginate($this->paginate);
        return view('livewire.user.payment-list',[
            'data' => $data
        ]);
    }
}
