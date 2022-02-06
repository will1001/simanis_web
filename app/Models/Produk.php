<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    public $incrementing = false;

    protected $fillable = [
        'id_badan_usaha',
        'nama',
        'deskripsi',
        'foto',
    ];
}
