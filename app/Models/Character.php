<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');
    
    public static $rules = array(
        'ch_name' => 'required',
        'ch_introduction' => 'required',
    );
    
    // Charater Modelに関連付けを行う
    public function ch_histories(){
        return $this->hasMany('App\Models\Ch_History');
    }
}
