<?php

namespace App\Livewire;

use App\Models\JenisPaket;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class JenisPaketList extends Component
{
    use WithPagination;
    #[Title('Jenis Paket')]
    public $title = 'Jenis Paket';
    public $id, $nama, $isActive;
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
        $data = JenisPaket::where('nama', 'like', '%' . $this->search . '%')
            ->paginate($this->paginate);
        return view('livewire.jenis-paket-list',[
            'data' => $data
        ]);
    }
    public function udaptedSearch()
    {
        $this->resetPage();
    }
    public function blankForm()
    {
        $this->nama = '';
        $this->isActive = (bool) false;
    }
    public function addPost()
    {
        $this->postAdd = true;
        $this->isStatus = 'create';
        $this->blankForm();
    }
    public function close()
    {
        $this->postAdd = false;
    }
    public function edit($id)
    {
        $this->isStatus = 'edit';
        $data = JenisPaket::find($id);
        $this->id = $data->id;
        $this->nama = $data->nama;
        $this->isActive = (bool) $data->isActive;
    }
    public function save()
    {
        $this->validate([
            'nama' => 'required|min:3|unique:jenis_pakets,nama,' . $this->id,
        ]);
        JenisPaket::updateOrCreate(['id' => $this->id], [
            'nama' => $this->nama,
            'isActive' => (bool) $this->isActive,
        ]);
        if ($this->isStatus == 'create') {
            $this->dispatch('swal', [
                'title' => 'Success!',
                'text' => 'Data berhasil disimpan',
                'icon' => 'success',
            ]);
            $this->addPost();
        } else {
            $this->dispatch('swal', [
                'title' => 'Success!',
                'text' => 'Data berhasil diedit',
                'icon' => 'success',
            ]);
        }
        $this->dispatch('close-modal');
    }
    public function cofirmDelete($id)
    {
        $this->dispatch('confirm', id: $id);
    }
    #[On('delete')]
    public function delete($id)
    {
        try {
            JenisPaket::find($id)->delete();
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
