<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Percentage extends Model {
    
    use HasFactory;
    protected $primaryKey = 'id_percentage';
    protected $table = 'percentages';
    static $rules = ['id_course' => 'required','id_class' => 'required','continuous_assessment' => 'required','exams' => 'required'];
    protected $fillable = ['id_course','id_class','continuous_assessment','exams'];

}