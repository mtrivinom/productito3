<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admins extends Model {

    use HasFactory;
    protected $primaryKey = 'id_user_admin';
    protected $table = 'useradmins';
    static $rules = ['username' => 'required','name' => 'required','email' => 'required','password' => 'required'];
    protected $fillable = ['username','name','email','password'];

}