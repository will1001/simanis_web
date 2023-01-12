<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNTBMall extends Model
{
    use HasFactory;

    protected $table = 'user_ntb_mall';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'phone',
        'password',
    ];
}
