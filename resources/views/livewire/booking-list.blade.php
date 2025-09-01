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
                        <td>{{ $item->user->name }}</td>
                        <td><img src="{{ asset('storage/' . $item->paket->gambar) }}" alt="{{ $item->paket->nama }}"
                                class="img-circle img-size-32 mr-2">
                            {{ $item->paket->nama }}
                        </td>
                        <td>{{ number_format($item->paket->harga) }}</td>
                        <td>{{ $item->jml_orang }}</td>
                        <td>{{ number_format($item->paket->harga * $item->jml_orang) }}</td>
                        <td>
                            @if ($item->status == 'Pending')
                                <span class="badge badge-warning">{{ $item->status }}</span>
                            @endif
                            @if ($item->status == 'Confirmed')
                                <span class="badge badge-info">{{ $item->status }}</span>
                            @endif
                            @if ($item->status == 'Cancelled')
                                <span class="badge badge-danger">{{ $item->status }}</span>
                            @endif
                            @if ($item->status == 'Completed')
                                <span class="badge badge-success">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($item->status == 'Pending')
                                <button wire:click="payment({{ $item->id }})" class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i> Payment
                                </button>
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
