<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    protected $table = 'password_reset_tokens';

    protected $primaryKey = 'email';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

    // protected $casts = [
    //     'email' => 'string',
    //     'token' => 'string',
    //     'created_at' => 'datetime',
    // ];
}
