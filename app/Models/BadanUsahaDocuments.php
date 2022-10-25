<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadanUsahaDocuments extends Model
{
    use HasFactory;

    protected $table = 'badan_usaha_documents';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_badan_usaha',
        'nib_file',
        'bentuk_usaha_file',
        'sertifikat_halal_file',
        'sertifikat_sni_file',
        'sertifikat_merek_file',
    ];
  
}
