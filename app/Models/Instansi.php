<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansi';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'nama',
    ];
  
}
