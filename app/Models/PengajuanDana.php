<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_dana';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'status',
        'jumlah_dana',
    ];
}
