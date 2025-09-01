@props(['warna' => config('app.warna'), 'judul'])
<div class="card card-{{ $warna }}">
    <div class="card-header">
        <h3 class="card-title">Data {{ $judul }}</h3>
        <div class="card-tools">
            <x-button-add type="button" modal="Ya" />
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        {{ $slot }}
    </div>
</div>
