<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
    
    use HasFactory;
    protected $primaryKey = 'id_schedule';
    protected $table = 'schedule';
    static $rules = ['id_class' => 'required','time_start' => 'required','time_end' => 'required','day' => 'required'];
    protected $fillable = ['id_class','time_start','time_end','day'];

}