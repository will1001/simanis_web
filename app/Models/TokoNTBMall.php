<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokoNTBMall extends Model
{
    use HasFactory;

    protected $table = 'toko_ntb_mall';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'description',
        'is_actived',
    ];
}
