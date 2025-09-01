<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'paket_id',
        'user_id',
        'status',
        'jml_orang',
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
