<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model {
    
    use HasFactory;
    protected $primaryKey = 'id_exam';
    protected $table = 'exams';
    static $rules = ['id_class' => 'required','id_student' => 'required','name' => 'required','mark' => 'required'];
    protected $fillable = ['id_class','id_student','name','mark'];
    
}