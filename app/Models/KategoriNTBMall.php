<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriNTBMall extends Model
{
    use HasFactory;

    protected $table = 'kategori_ntb_mall';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'text',
    ];
}
