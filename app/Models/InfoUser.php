<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    protected $fillable =[
        'user_id',
        'nik',
        'no_hp',
        'fc_ktp',
        'alamat',
    ];
}
