<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReadingContentLatihanSoal extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'text_content',
    ];

    public function LatihanSoal() :HasMany
    {
        return $this->hasMany(LatihanSoal::class);
    }
}
