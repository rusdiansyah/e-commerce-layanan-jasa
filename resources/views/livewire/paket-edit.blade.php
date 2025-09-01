<div class="card">
    <div class="card-header">{{ $title }}</div>
    <form wire:submit.prevent="save">
    <div class="card-body">
        <x-form-select name="jenis_paket_id" label="Jenis Paket">
            <option value="">-Pilih-</option>
            @foreach ($this->listJenis() as $jenis)
                <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
            @endforeach
        </x-form-select>
        <x-form-input name="nama" label="Nama" />
        <div class="row">
            <div class="col-md-4">
                <x-form-input name="lama" label="Lama" />
            </div>
            <div class="col-md-4">
                <x-form-input type="date" name="tgl_mulai" label="Tanggal Mulai" />
            </div>
            <div class="col-md-4">
                <x-form-input type="date" name="tgl_selesai" label="Tanggal Selesai" />
            </div>
        </div>
        <x-form-text-area name="deskripsi" label="Deskripsi" />
        <div class="row">
            <div class="col-md-6">
                <x-form-input type="number" name="harga" label="Harga" />
            </div>
            <div class="col-md-6">
                <x-form-input type="number" name="max_orang" label="Maximal Orang" />
            </div>
        </div>
        <x-form-input type="file" name="gambar" label="Gambar" />

        <x-form-checkbox name="isActive" label="Aktif" />
    </div>
    <div class="card-footer text-center">
        <x-button-save />
        <a href="{{ route('produk.paketList') }}" class="btn btn-primary">
           <i class="fa fa-backward"></i> Kembali</a>
    </div>
    </form>
</div>
