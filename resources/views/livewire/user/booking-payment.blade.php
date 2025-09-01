<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $nama_paket }}</h3>
            <div class="card-tools">
                <a href="{{ route('user.bookingList') }}" class="btn btn-sm btn-primary" >
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $gambar) }}" alt="{{ $nama_paket }}" width="100%">
                </div>
                <div class="col-md-8">
                    <h5 class="text-primary">{{ $jenis_paket }}</h5>
                    <h5>{{ $nama_paket }}</h5>
                    <h5>{{ $lama }}</h5>
                    <h5>{{ $tanggal }}</h5>
                    <h5>Rp {{ number_format($harga) }} x {{ $jml_orang }}
                        <button type="button" class="btn btn-xs btn-primary pl-2 pr-2"
                            wire:click="kurang({{ $paket_id }})">-</button>
                        <button type="button" class="btn btn-xs btn-primary pl-2 pr-2"
                            wire:click="tambah({{ $paket_id }})">+</button>
                    </h5>
                    <h5 class="text-success"><b>Rp {{ number_format($subTotal) }}</b></h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form-input name="nik" label="NIK" />
                        </div>
                        <div class="col-md-6">
                            <x-form-input name="no_hp" label="No HP" />
                        </div>
                    </div>
                    <x-form-text-area name="alamat" label="Alamat" />
                    <hr>
                    <form wire:submit="handleUpload">
                        <x-form-input type="file" name="buktiBayar" label="Bukti Bayar" />
                        <x-button-save type="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
