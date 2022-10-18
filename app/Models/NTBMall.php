<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'ntb_mall_data';
    public $incrementing = false;
    protected $casts = ['id' => 'string'];


    protected $fillable = [
        'id',
        'user',
        'store',
        'produk'
    ];
}