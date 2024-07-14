<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reponseModel extends Model
{
    use HasFactory;
    protected $table = 'table_reponses';
    protected $fillable = [
        'id',
        'reponse',
        'question',
        'status',
    ];

    public function question(){
        return $this->belongsTo(questionModel::class, 'question');
    }
}
