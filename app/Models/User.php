<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable {

    use HasFactory, HasApiTokens, Notifiable;
    protected $primaryKey = 'id';
    protected $table = 'users';
    static $rules = ['username' => 'required','name' => 'required','email' => 'required','password' => 'required','type' => 'required'];
    protected $fillable = ['username','name','email','password','type'];
    protected $hidden = ['password','remember_token',];
    protected $casts = ['email_verified_at' => 'datetime'];

}
