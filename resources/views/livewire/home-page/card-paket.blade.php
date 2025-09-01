<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
    <div class="card bg-light d-flex flex-fill">
        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="">
        <div class="card-header text-muted border-bottom-0">
            {{ $item->jenis->nama }}
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-12">
                    <h2 class="lead"><b>{{ $item->nama }}</b></h2>
                    <p class="text-muted text-sm"><b>Deskripsi: </b> {{ $item->deskripsi }} </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span> Lama:
                            {{ $item->lama }}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span> Tanggal:
                            {{ \Carbon\Carbon::parse($item->tgl_mulai)->format('d-m-Y') }} s.d {{ \Carbon\Carbon::parse($item->tgl_selesai)->format('d-m-Y') }}
                        </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-bullhorn"></i></span> Harga:
                            {{ number_format($item->harga) }}/orang</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-right">
                <a href="{{ route('paket-detail',$item->id) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-list-alt"></i> Detail
                </a>
            </div>
        </div>
    </div>
</div>
