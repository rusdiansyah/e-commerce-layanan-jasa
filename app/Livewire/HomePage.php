<?php

namespace App\Livewire;

use App\Models\Paket;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;
    #[Layout('components.layouts.front-end')]
    #[Title('Home Page')]
    public $title = 'Home Page';
    public $paginate = 10;



    public function mount()
    {
        $this->title;
    }
    public function render()
    {
        $data = Paket::where('isActive', 1)
            ->paginate($this->paginate);
        return view('livewire.home-page',[
            'data' => $data
        ]);
    }
}
