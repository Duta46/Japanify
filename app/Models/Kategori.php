<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name'
    ];

    public function SoalUjian() :HasMany
    {
        return $this->hasMany(SoalUjian::class, 'kategori_id', 'id');
    }

    public function LatihanSoal() :HasMany
    {
        return $this->hasMany(LatihanSoal::class, 'kategori_id', 'id');
    }

}
