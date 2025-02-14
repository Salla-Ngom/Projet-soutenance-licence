<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';
    protected $fillable = [
        'quiz',
        'note',
    ];

    public function quiz(){
        return $this->belongsTo(quiz::class,'quiz');
    }
}
