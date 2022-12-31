<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model {
    
    use HasFactory;
    protected $primaryKey = 'id_enrollment';
    protected $table = 'enrollments';
    static $rules = ['id_student' => 'required','id_course' => 'required','status' => 'required'];
    protected $fillable = ['id_student','id_course','status'];

}