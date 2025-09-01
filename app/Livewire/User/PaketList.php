<?php

namespace App\Livewire\User;

use App\Models\JenisPaket;
use App\Models\Paket;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class PaketList extends Component
{
    use WithPagination;
    #[Title('Paket')]
    public $title = 'Paket';
    public $paginate = 10;
    public $search;
    public $filterJenis;
    public function mount()
    {
        $this->title;
    }
    #[Computed()]
    public function listJenis()
    {
        return JenisPaket::latest()->get();
    }
    public function render()
    {
        $data = Paket::where('nama', 'like', '%' . $this->search . '%')
            ->where('isActive', 1)
            ->when($this->filterJenis,function($q){
                return $q->where('jenis_paket_id',$this->filterJenis);
            })
            ->paginate($this->paginate);
        return view('livewire.user.paket-list',[
            'data' => $data
        ]);
    }
}
