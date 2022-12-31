<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model {

    use HasFactory;
    protected $primaryKey = 'id_teacher';
    protected $table = 'teachers';
    static $rules = ['name' => 'required','surname' => 'required','telephone' => 'required','nif' => 'required','email' => 'required'];
    protected $fillable = ['name','surname','telephone','nif','email'];

}