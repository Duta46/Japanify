<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;

class PaketSoalLatihanSoal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'paket_soal_latihan_soals';

    protected $fillable = [
        'name',
        'jumlah_soal',
        'kategori_test_id',
    ];

    public function LatihanSoal(): HasMany
    {
        return $this->hasMany(LatihanSoal::class);
    }

    public function KategoriTest() :BelongsTo
    {
        return $this->belongsTo(KategoriTest::class);
    }
}
