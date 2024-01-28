<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaketSoal extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'jumlah_soal',
        'kategori_test_id',
    ];

    public function SoalUjian(): HasMany
    {
        return $this->hasMany(SoalUjian::class);
    }

    public function ReadingUjian(): HasMany
    {
        return $this->hasMany(ReadingContentUjian::class);
    }

    public function KategoriTest() :BelongsTo
    {
        return $this->belongsTo(KategoriTest::class);
    }
}
