<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;


class Dashboard extends Component
{
    #[Title('Dashboard')]
    public $title='Dashboard';
    public $jmlUser=0;
    public function mount()
    {
        $this->title;
        $this->jmlUser = User::count();
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
