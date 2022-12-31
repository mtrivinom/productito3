<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model {

    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'students';
    static $rules = ['username' => 'required','pass' => 'required','email' => 'required','name' => 'required','surname' => 'required','telephone' => 'required','nif' => 'required','date_registered' => 'required'];
    protected $fillable = ['username','pass','email','name','surname','telephone','nif','date_registered'];

}