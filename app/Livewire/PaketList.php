<?php

namespace App\Livewire;

use App\Models\JenisPaket;
use App\Models\Paket;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Throwable;

class PaketList extends Component
{
    use WithFileUploads;
    use WithPagination;
    #[Title('Paket')]
    public $title = 'Paket';
    public $id, $jenis_paket_id, $nama, $deskripsi, $lama, $tgl_mulai, $tgl_selesai, $harga, $gambar, $max_orang, $isActive;
    public $postAdd = false;
    public $isStatus;
    public $paginate = 10;
    public $search;
    public function mount()
    {
        $this->title;
        $this->isStatus = 'create';
    }
    #[Computed()]
    public function listJenis()
    {
        return JenisPaket::latest()->get();
    }
    public function render()
    {
        $data = Paket::where('nama', 'like', '%' . $this->search . '%')
            ->paginate($this->paginate);
        return view('livewire.paket-list', [
            'data' => $data
        ]);
    }
    public function udaptedSearch()
    {
        $this->resetPage();
    }
    public function blankForm()
    {
        $this->jenis_paket_id = '';
        $this->nama = '';
        $this->deskripsi = '';
        $this->lama = '';
        $this->tgl_mulai = '';
        $this->tgl_selesai = '';
        $this->harga = '';
        $this->gambar = '';
        $this->max_orang = '';
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

    public function save()
    {

        $this->validate([
            'nama' => 'required|min:3|unique:pakets,nama,' . $this->id,
            'jenis_paket_id' => 'required',
            'deskripsi' => 'required',
            'lama' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'harga' => 'required|numeric',
            'max_orang' => 'required|numeric',
            'gambar' => 'required|image',
        ]);
        $path = $this->gambar->store('paket', 'public');
        Paket::updateOrCreate(['id' => $this->id], [
            'nama' => $this->nama,
            'jenis_paket_id' => $this->jenis_paket_id,
            'deskripsi' => $this->deskripsi,
            'lama' => $this->lama,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_selesai' => $this->tgl_selesai,
            'harga' => $this->harga,
            'max_orang' => $this->max_orang,
            'gambar' => $path,
            'isActive' => (bool) $this->isActive,
        ]);
        $this->dispatch('swal', [
            'title' => 'Success!',
            'text' => 'Data berhasil disimpan',
            'icon' => 'success',
        ]);
        $this->addPost();
        $this->dispatch('close-modal');
    }
    #[On('delete-paket')]
    public function delete($id)
    {
        Paket::find($id)->delete();
        $this->dispatch('swal', [
            'title' => 'Success!',
            'text' => 'Data berhasil dihapus',
            'icon' => 'success',
        ]);
    }
}
