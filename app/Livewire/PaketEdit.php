<?php

namespace App\Livewire;

use App\Models\JenisPaket;
use App\Models\Paket;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class PaketEdit extends Component
{
    #[Title('Edit Paket')]
    public $title = 'Edit Paket';
    public $id, $jenis_paket_id, $nama, $deskripsi, $lama, $tgl_mulai, $tgl_selesai, $harga, $gambar, $max_orang, $isActive;
    public function mount($id)
    {
        // dd($id);
        $this->title;
        $data = Paket::where('id', $id)->first();
        $this->id = $data->id;
        $this->jenis_paket_id = $data->jenis_paket_id;
        $this->nama = $data->nama;
        $this->deskripsi = $data->deskripsi;
        $this->lama = $data->lama;
        $this->tgl_mulai = $data->tgl_mulai;
        $this->tgl_selesai = $data->tgl_selesai;
        $this->harga = $data->harga;
        // $this->gambar = $data->gambar;
        $this->max_orang = $data->max_orang;
        $this->isActive = (bool) $data->isActive;
    }
    #[Computed()]
    public function listJenis()
    {
        return JenisPaket::latest()->get();
    }
    public function render()
    {
        return view('livewire.paket-edit');
    }
    public function save()
    {
        // dd($this->all());
        $this->validate([
            'nama' => 'required|min:3|unique:pakets,nama,' . $this->id,
            'jenis_paket_id' => 'required',
            'deskripsi' => 'required',
            'lama' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'harga' => 'required|numeric',
            'max_orang' => 'required|numeric',
        ]);
        $data = Paket::where('id',$this->id)->first();
        $data->jenis_paket_id = $this->jenis_paket_id;
        $data->nama = $this->nama;
        $data->deskripsi = $this->deskripsi;
        $data->lama = $this->lama;
        $data->tgl_mulai = $this->tgl_mulai;
        $data->tgl_selesai = $this->tgl_selesai;
        $data->harga = $this->harga;
        $data->max_orang = $this->max_orang;
        if ($this->gambar)
        {
            $path = $this->gambar->store('paket', 'public');
            $data->gambar = $path;
        }
        $data->save();
        $this->dispatch('swal', [
            'title' => 'Success!',
            'text' => 'Data berhasil disimpan',
            'icon' => 'success',
        ]);
        return $this->redirectRoute('produk.paketList');

    }
}
