<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReadingContentLatihanSoal extends Model
{
    use HasFactory;

    protected $table = 'reading_content_latihan_soals';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'text_content',
        'image_content',
        'paket_soal_latihan_soal_id',
    ];

    public function LatihanSoal() :HasMany
    {
        return $this->hasMany(LatihanSoal::class);
    }

    public function PaketSoalLatihanSoal() :BelongsTo
    {
        return $this->belongsTo(PaketSoalLatihanSoal::class);
    }
}
