<?php

namespace App\Livewire;

use App\Models\JenisPaket;
use App\Models\Paket;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class JenisPaketFilter extends Component
{
    use WithPagination;
    #[Layout('components.layouts.front-end')]
    #[Title('Jenis Paket')]
    public $title = 'Jenis Paket';
    public $paginate = 10;
    public $id;
    public function mount($id)
    {
        $jenis = JenisPaket::findOrFail($id);
        $this->title.' '.$jenis->nama;
        $this->id = $id;
    }
    public function render()
    {
        $data = Paket::where('isActive', 1)
        ->where('jenis_paket_id',$this->id)
            ->paginate($this->paginate);
        return view('livewire.jenis-paket-filter',[
            'data' => $data
        ]);
    }
}
