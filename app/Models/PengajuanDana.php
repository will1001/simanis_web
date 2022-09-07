<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanDana extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_dana';
    public $incrementing = false;
    protected $casts = ['id' => 'string'];


    protected $fillable = [
        'id',
        'id_instansi',
        'user_id',
        'status',
        'jumlah_dana',
        'alasan',
        'instansi',
        'jenis_pengajuan',
    ];
}
