<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPendukung extends Model
{
    use HasFactory;

    protected $table = 'data_tambahan';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_badan_usaha',
        'ktp',
        'kk',
        'ktp_pasangan',
    ];
  
}
