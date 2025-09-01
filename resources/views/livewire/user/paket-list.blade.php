<div>
    <x-card-filter judul="{{ $title }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="filterJenis">Jenis</label>
                    <select wire:model.live="filterJenis" class="form-control">
                        <option value="">-Pilih-</option>
                        @foreach ($this->listJenis() as $lj)
                            <option value="{{ $lj->id }}">{{ $lj->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </x-card-filter>
    <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        @if ($data)
            <div class="card-body pb-0">
                <div class="row">
                    @foreach ($data as $item)
                        <livewire:user.card-paket :key="$item->id" :$item />
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
