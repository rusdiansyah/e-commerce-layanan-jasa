<div>
    <x-card judul="{{ $title }}">
        <x-table-search />

        <table class="table table-hover text-nowrap table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Paket</th>
                    <th>Harga</th>
                    <th>Jml Orang</th>
                    <th>Sub Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $data->firstItem() + $loop->index }}</td>
                        <td>{{ $item->booking->user->name }}</td>
                        <td><img src="{{ asset('storage/' . $item->booking->paket->gambar) }}"
                                alt="{{ $item->booking->paket->nama }}" class="img-circle img-size-32 mr-2">
                            {{ $item->booking->paket->nama }}
                        </td>
                        <td>{{ number_format($item->booking->paket->harga) }}</td>
                        <td>{{ $item->booking->jml_orang }}</td>
                        <td>{{ number_format($item->booking->paket->harga * $item->booking->jml_orang) }}</td>
                        <td>
                            @if ($item->status == 'Pending')
                                <span class="badge badge-warning">{{ $item->status }}</span>
                            @endif
                            @if ($item->status == 'Failed')
                                <span class="badge badge-danger">{{ $item->status }}</span>
                            @endif
                            @if ($item->status == 'Paid')
                                <span class="badge badge-success">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td>

                                <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-success"
                                    data-toggle="modal" data-target="#modalForm">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            @if ($item->status == 'Pending')
                                <x-button-delete id="{{ $item->id }}" />
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="p-4">
            {{ $data->links() }}
        </div>
    </x-card>

    <x-form-modal save="save" title="{{ $title }}" size="modal-lg">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $gambar) }}" alt="{{ $this->nama_paket }}" width="100%">
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input name="nik" label="NIK" readonly />
                    </div>
                    <div class="col-md-6">
                        <x-form-input name="nohp" label="No Handphone" readonly />
                    </div>
                </div>
                <x-form-text-area name="alamat" label="Alamat" />
            </div>
            <div class="col-md-6">
                <x-form-input name="user" label="Pelanggan" readonly />
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input name="jml_orang" label="Jumlah Orang" readonly />
                    </div>
                    <div class="col-md-6">
                        <x-form-input name="statusBooking" label="Status Booking" readonly />
                    </div>
                </div>

                <x-form-input name="nama_paket" label="Nama Paket" readonly />
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input name="harga_paket" label="Harga Paket" readonly />
                    </div>
                    <div class="col-md-6">
                        <x-form-input name="total" label="Harga Total" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input name="metode" label="Metode" readonly />
                    </div>
                    <div class="col-md-6">
                        <label for="">Bukti</label> <br>
                        <a href="{{ asset('storage/' . $this->bukti) }}" class="btn btn-info" target="_blank">
                            <i class="fa fa-eye"></i> Lihat</a>
                    </div>
                </div>
                <x-form-select name="status" label="Status Pembayaran">
                    <option value="">-Pilih-</option>
                    @foreach ($this->listStatus() as $ls)
                        <option value="{{ $ls }}">{{ $ls }}</option>
                    @endforeach
                </x-form-select>
            </div>
        </div>
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
                    $wire.dispatch("delete", {
                        id: event.id
                    });
                }
            });
        });
    </script>
@endscript
