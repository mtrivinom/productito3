<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Works extends Model {
    
    use HasFactory;
    protected $primaryKey = 'id_work';
    protected $table = 'works';
    static $rules = ['id_class' => 'required','id_student' => 'required','name' => 'required','mark' => 'required'];
    protected $fillable = ['id_class','id_student','name','mark'];

}