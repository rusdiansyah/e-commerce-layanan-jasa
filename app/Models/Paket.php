<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = [
        'jenis_paket_id',
        'nama',
        'deskripsi',
        'lama',
        'tgl_mulai',
        'tgl_selesai',
        'harga',
        'gambar',
        'max_orang',
        'isActive',
    ];

    public function jenis(){
        return $this->belongsTo(JenisPaket::class,'jenis_paket_id');
    }
}
