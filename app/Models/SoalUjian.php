<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoalUjian extends Model
{
    use HasFactory;

    protected $table = 'soal_ujians';

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
        'paket_soal_id',
        'kategori_id',
        'reading_ujian_id',
        'kategori_test_id',
        'text_content',
        'image_content',
    ];

    public function PaketSoal() :BelongsTo
    {
        return $this->belongsTo(PaketSoal::class);
    }

    public function Kategori() :BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function ReadingUjian() :BelongsTo
    {
        return $this->belongsTo(ReadingContentUjian::class);
    }

    public function KategoriTest() :BelongsTo
    {
        return $this->belongsTo(KategoriTest::class);
    }
}
