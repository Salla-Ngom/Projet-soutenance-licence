<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    use HasFactory;
    protected $table = 'quizzes';
    protected $fillable = [
        'id',
        'titre_quiz',
        'user',
        'matiere',
    ];

    public function question(){
        return $this->hasMany(questionModel::class, 'quiz');
    }
    public function matiere()
    {
        return $this->belongsTo(matiere::class, 'matiere');
    }
    public function notes()
    {
        return $this->hasMany(Note::class, 'quiz');
    }
    public function professeur()
    {
        return $this->belongsTo(User::class, 'user');
    }
    public function getMaxNoteAttribute()
    {
        return $this->notes->max('note');
    }

    // Accessor for min_note
    public function getMinNoteAttribute()
    {
        return $this->notes->min('note');
    }
}
