<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCabangIndustri extends Model
{
    use HasFactory;

    protected $table = 'sub_cabang_industri';
    public $incrementing = false;

    protected $fillable = [
        'name',
    ];
}
