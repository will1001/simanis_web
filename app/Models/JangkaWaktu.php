<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JangkaWaktu extends Model
{
    use HasFactory;

    protected $table = 'list_jangka_waktu';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_instansi',
        'waktu',
    ];
}
