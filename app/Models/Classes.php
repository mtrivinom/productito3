<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model {

    use HasFactory;
    protected $primaryKey = 'id_class';
    protected $table = 'classes';
    static $rules = ['id_teacher' => 'required','id_course' => 'required','id_schedule' => 'required','name' => 'required','color' => 'required'];
    protected $fillable = ['id_teacher','id_course','id_schedule','name','color'];

}