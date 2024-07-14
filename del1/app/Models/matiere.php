<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matiere extends Model
{
    use HasFactory;

    protected $fillable = ['id','nom',];

    public function tps()
    {
        return $this->hasMany(Tp::class, 'matiere');
    }
    public function quizzes()
    {
        return $this->hasMany(quiz::class, 'matiere');
    }
}
