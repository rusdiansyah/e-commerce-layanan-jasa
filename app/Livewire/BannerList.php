<?php

namespace App\Livewire;

use App\Models\Banner;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Throwable;

class BannerList extends Component
{
    use WithFileUploads;
    use WithPagination;
    #[Title('Banner')]
    public $title = 'Banner';
    public $id,$judul,$gambar,$isActive;
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
        $data = Banner::where('judul', 'like', '%' . $this->search . '%')
            ->paginate($this->paginate);
        return view('livewire.banner-list',[
            'data' => $data
        ]);
    }
    public function udaptedSearch()
    {
        $this->resetPage();
    }
    public function blankForm()
    {
        $this->judul = '';
        $this->gambar = '';
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
        $data = Banner::find($id);
        $this->id = $data->id;
        $this->judul = $data->judul;
        $this->gambar = $data->gambar;
        $this->isActive =(bool) $data->isActive;
    }
    public function save()
    {
        $this->validate([
            'judul' => 'required|min:3|unique:banners,judul,' . $this->id,
            'gambar' => 'required|image',
        ]);
        $path = $this->gambar->store('banner', 'public');
        Banner::updateOrCreate(['id' => $this->id], [
            'judul' => $this->judul,
            'gambar' => $path,
            'isActive' =>(bool) $this->isActive,
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
            Banner::find($id)->delete();
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
