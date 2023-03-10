<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    // 以下から課題による追記
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
        );
    
    // Profile Model から $profiles->backgrounds() の記述で簡単にアクセスできる
    public function backgrounds(){
        return $this->hasMany('App\Models\Background');
    }
}
