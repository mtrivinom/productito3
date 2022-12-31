<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model {
    
    use HasFactory;
    protected $primaryKey = 'id_notification';
    protected $table = 'notifications';
    static $rules = ['id_student' => 'required','work' => 'required','exam' => 'required','continuous_assessment' => 'required','final_note' => 'required'];
    protected $fillable = ['id_student','work','exam','continuous_assessment','final_note'];

}