<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model {

    use HasFactory;
    protected $primaryKey = 'id_course';
    protected $table = 'courses';
    static $rules = ['name' => 'required','description' => 'required','date_start' => 'required','date_end' => 'required','active' => 'required'];
    protected $fillable = ['name', 'description', 'date_start', 'date_end', 'active'];

}