<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questionModel extends Model
{
    use HasFactory;
    protected $table = 'table_question';
    protected $fillable = [
        'id',
        'contenu',
        'quiz',
    ];
    public function reponse(){
        return $this->hasMany(reponseModel::class,'question');
    }
    public function quiz(){
        return $this->belongsTo(quiz::class,'quiz');
    }
}
