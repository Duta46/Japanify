<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriTest extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $table = 'kategori_tests';

    protected $fillable = [
        'name',
        'point_ujian',
    ];

    public function PaketSoal() :HasMany
    {
        return $this->hasMany(PaketSoal::class, 'kategori_test_id', 'id');
    }

    public function UjianSoal() :HasMany
    {
        return $this->hasMany(LatihanSoal::class, 'kategori_test_id', 'id');
    }

    public function LatihanSoal() :HasMany
    {
        return $this->hasMany(LatihanSoal::class, 'kategori_test_id', 'id');
    }

}
