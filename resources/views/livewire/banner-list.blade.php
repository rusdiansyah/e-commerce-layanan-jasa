<div>
    <x-card-table judul="{{ $title }}">
        <x-table-search />

        <table class="table table-hover text-nowrap table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $data->firstItem() + $loop->index }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" width="50">
                            </a>
                        </td>
                        <td>
                            @if ($item->isActive)
                                <i class="fa fa-check-circle text-success"></i>
                            @endif
                        </td>
                        <td>
                            <x-button-edit id="{{ $item->id }}" type="button" modal="Ya" />
                            <x-button-delete id="{{ $item->id }}" />
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="p-4">
            {{ $data->links() }}
        </div>
    </x-card-table>

    {{-- modal --}}
    <x-form-modal save="save" title="{{ $title }}">
        <x-form-input name="judul" label="Judul" />
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
                    $wire.dispatch("delete", {
                        id: event.id
                    });
                }
            });
        });
    </script>
@endscript
