<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下の一行を追記することでProfile Modelが扱えるようになる
use App\Models\Profile;

class ProfileController extends Controller
{
    // 以下に追記
        public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        // laravel課題09記述
        // validationを行う 「::」->どういう意味?
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        $form = $request->all();
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }

    public function edit(Request $request){
        
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit');
    }

    public function update()
    {
        return redirect('admin/profile');
    }
    
}
