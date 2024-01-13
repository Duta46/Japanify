<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReadingContentUjian extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'text_content',
        'paket_soal_id'

    ];

    public function SoalUjian() :HasMany
    {
        return $this->hasMany(SoalUjian::class);
    }

    public function PaketSoal() :BelongsTo
    {
        return $this->belongsTo(PaketSoal::class);
    }
}
