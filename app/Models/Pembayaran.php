<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'booking_id',
        'metode',
        'total',
        'status',
        'bukti',
    ];

    public function booking()
    {
        return $this->hasOne(Booking::class, 'id','booking_id');
    }
}
