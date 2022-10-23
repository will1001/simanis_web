<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'alamat_kop',
        'nama_kadis',
        'nip',
        'jabatan',
        'alamat',
        'nomor_surat',
        'ttd',
    ];
}
