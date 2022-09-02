<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyChart extends Model
{
    use HasFactory;
    protected $casts = ['id' => 'string'];


    protected $table = 'survey_chart';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nik',
        'deskripsi',
    ];
}
