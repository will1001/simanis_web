<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabangIndustri extends Model
{
    use HasFactory;

    protected $table = 'cabang_industri';
    public $incrementing = false;

    protected $fillable = [
        'nama',
    ];
  
}
