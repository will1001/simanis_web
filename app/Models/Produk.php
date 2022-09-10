<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    public $incrementing = false;
    protected $casts = ['id' => 'string'];


    protected $fillable = [
        'id',
        'id_badan_usaha',
        'sertifikat_halal',
        'sertifikat_haki',
        'sertifikat_sni',
        'nama',
        'deskripsi',
        'foto',
        'harga',
    ];
}
