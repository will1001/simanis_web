<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KecamatanNTBMall extends Model
{
    use HasFactory;

    protected $table = 'kecamatan_ntb_mall';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_kabupaten',
        'name',
    ];
}
