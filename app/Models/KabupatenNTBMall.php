<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabupatenNTBMall extends Model
{
    use HasFactory;

    protected $table = 'kabupaten_ntb_mall';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
    ];
}
