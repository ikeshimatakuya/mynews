<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    // 以下を追記
    protected $guarded = array('id');
    
    public static $rules = array(
        // required に設定することで必須項目となる
        'title' => 'required',
        'body' => 'required',
        );
        
        // New Modelに関連付けを行う
        public function histories(){
            return $this->hasMany('App\Models\History');
            // News Model から $news->histories() で簡単にアクセスすることができる
        }
}
