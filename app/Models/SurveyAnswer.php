<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'survey_id',
        'question_id',
        'answer',
        'question_number', // pastikan ini dimasukkan jika kolom ini ada di DB
    ];

    // Relasi SurveyAnswer belongs to Survey
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
    
    public function question()
{
    return $this->belongsTo(Question::class);
}

}
