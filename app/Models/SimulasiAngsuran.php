<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulasiAngsuran extends Model
{
    use HasFactory;

    protected $table = 'simulasi_angsuran';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_instansi',
        'id_jml_pinjaman',
        'id_jangka_waktu',
        'angsuran',
    ];
}
