<div>
    <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" wire:click="addPost" data-toggle="modal"
                    data-target="#modalForm">
                    <i class="fas fa-plus"></i>
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                @foreach ($data as $item)
                    <livewire:card-paket :key="$item->id" :$item />
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            {{ $data->links() }}
        </div>
    </div>

    {{-- modal --}}
    <x-form-modal save="save" title="{{ $title }}" size="modal-lg">
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

    </x-form-modal>

</div>
@script
    <script>
        $wire.on('close-modal', () => {
            $(".btn-close").trigger("click");
        });

        $wire.on("confirm", (event) => {
            Swal.fire({
                title: "Yakin dihapus?",
                text: "Anda tidak dapat mengembalikannya!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch("delete-paket", {
                        id: event.id
                    });
                }
            });
        });
    </script>
@endscript
