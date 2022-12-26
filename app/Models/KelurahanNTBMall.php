<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelurahanNTBMall extends Model
{
    use HasFactory;

    protected $table = 'kelurahan_ntb_mall';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_kecamatan',
        'name',
        'postcode',
    ];
}
