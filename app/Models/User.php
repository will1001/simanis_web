<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $casts = ['id' => 'string'];
    protected $table = 'users';

    protected $fillable = [
        'id',
        'nik',
        'role',
        'status',
        'foto',
        'password',
    ];

    protected $hidden = [
        // 'password',
    ];

    public function badan_usaha(): BelongsTo
    {
        return $this->belongsTo(BadanUsaha::class, 'nik', 'nik');
    }

    public function instansi(): BelongsTo
    {
        return $this->belongsTo(Instansi::class, 'user_id');
    }
}
