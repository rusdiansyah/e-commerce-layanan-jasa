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

                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="p-4">
            {{ $data->links() }}
        </div>
    </x-card>

</div>
