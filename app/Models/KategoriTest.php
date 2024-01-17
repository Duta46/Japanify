<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriTest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_test';

    protected $fillable = [
        'name'
    ];
}
