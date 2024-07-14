<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tp extends Model
{
    use HasFactory;
    protected $table = 'tps';
    protected $fillable = [
        'id',
        'titre',
        'description',
        'chemin',
    ];
    public function matiere()
    {
        return $this->belongsTo(matiere::class, 'matiere');
    }

}
