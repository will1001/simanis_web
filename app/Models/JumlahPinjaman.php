<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahPinjaman extends Model
{
    use HasFactory;

    protected $table = 'list_jumlah_pinjaman';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_instansi',
        'jumlah',
    ];
}
