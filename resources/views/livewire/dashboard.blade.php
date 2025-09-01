<div>
    <x-card judul="{{ $title }}" >
    <h6 class="card-title">Hi <b>{{ Auth::user()->name }} [{{ Auth::user()->role->nama }}]</b> selamat datang
                di Sistem Informasi {{ config('app.name') }}</h6>
    </x-card>
    <div class="row">
        <x-chart warna="primary" judul="Jumlah User" jumlah="{{ $jmlUser }}" icon="person-add" route="user" />
    </div>
</div>
