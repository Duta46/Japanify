<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LatihanSoal extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'question',
        'question_image',
        'question_audio',
        'answer_a',
        'answer_a_image',
        'answer_b',
        'answer_b_image',
        'answer_c',
        'answer_c_image',
        'answer_d',
        'answer_d_image',
        'correct_answer',
        'point_soal',
        'kategori_id',
        'reading_latihan_soal_id',
    ];

    public function Kategori() :BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function ReadingLatihanSoal() :BelongsTo
    {
        return $this->belongsTo(ReadingContentLatihanSoal::class);
    }
}
