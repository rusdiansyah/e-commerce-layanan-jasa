<div class="card card-solid">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">{{ $data->nama }}</h3>
                <div class="col-12">
                    <img src="{{ asset('storage/'.$data->gambar) }}" class="product-image" alt="Product Image">
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3">{{ $data->nama }}</h3>
                <p>{{ $data->deskripsi }}</p>
                <hr>
                <h4>{{ $data->jenis->nama }}</h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-default text-center">
                        <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                        <span class="text-xl">{{ $data->lama }}</span>
                        <br>
                        {{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') }} s.d {{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') }}
                    </label>

                </div>

                <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                        Rp {{ number_format($data->harga) }} / orang
                    </h2>
                </div>

                <div class="mt-4">
                    <button type="button" wire:click="booking({{ $data->id }})" class="btn btn-primary btn-lg btn-flat">
                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                        Booking
                    </button>

                </div>

            </div>
        </div>

    </div>
    <!-- /.card-body -->
</div>
