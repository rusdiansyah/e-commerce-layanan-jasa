<div>
    <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        @if ($data)
            <div class="card-body pb-0">
                <div class="row">
                    @foreach ($data as $item)
                        <livewire:home-page.card-paket :key="$item->id" :$item />
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                {{ $data->links() }}
            </div>
        @else
            <div class="card-body">
                <p>Tidak Ada Data</p>
            </div>
        @endif
    </div>

</div>
