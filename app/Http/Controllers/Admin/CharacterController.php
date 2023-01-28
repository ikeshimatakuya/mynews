<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Character Model を使える様にする
use App\Models\Character;

use App\Models\Ch_History;

use Carbon\Carbon;

class CharacterController extends Controller
{
    public function add(){
        return view('admin.character.create');
    }
    
    public function create(Request $request){
        
        // Validationを行う
        $this->validate($request, Character::$rules);
        
        $character = new Character;
        // ユーザーが入力した情報を$formに格納
        $form = $request->all();
        
        // フォームから画像が送信されてきたら、保存して、$character->ch_image_path に画像のパスを保存する
        if (isset($form['image'])) {
            
            // file()メソッドは画像をアップロードするメソッド
            // store()メソッドはどこのフォルダにファイルを保存するか、パスを指定するメソッド
            $path = $request->file('image')->store('public/image');
            // $pathの中は「public/image/ハッシュ化されたファイル名」が入っていて、image_path にはファイル名のみを保存させたい
            // パスではなくファイル名だけを取得するbasename()メソッドを使う。このファイル名をimage_pathに代入。
            $character->ch_image_path = basename($path);
        } else {
            $character->ch_image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        // $form内の配列データをcharacterテーブルに代入
        $character->fill($form);
         // DBに保存する
        $character->save();
        
        return redirect('admin/character/create');
    }
    
    public function index(Request $request){
        // $requestの中のcond_ch_nameの値を$cond_ch_nameに代入している
        // もし、$requestにcond_ch_nlameがなければnullが代入される
        $cond_ch_name = $request->cond_ch_name;
        if ($cond_ch_name != '') {
            // charactersテーブルの中のtitleカラムで$cond_ch_title(ユーザーが入力した文字)に一致するレコードをすべて取得することができるようにする
            $posts = Character::where('ch_name', $cond_ch_name)->get();
        } else {
            // characterテーブルのレコードをすべて取得し、変数$postsに代入している
            $posts = Character::all();
        }
        // よく分からん
        return view('admin.character.index', ['posts' => $posts, 'cond_ch_name' => $cond_ch_name]);
    }
    
    public function edit(Request $request) {
        // Character Modelからデータを取得する
        $character = Character::find($request->id);
        if (empty($character)){
            abort(404);
        }
        return view('admin.character.edit', ['character_form' => $character]);
    }
    public function update(Request $request){
        // Validationをかける
        $this->validate($request, Character::$rules);
        // Character Modelからデータを取得する
        $character = Character::find($request->id);
        // dd($character);
        // 送信されてきたフォームデータを格納する
        $character_form = $request->all();
        
        if ($request->remove == 'true') {
            $character_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $character_form['image_path'] = basename($path);
        } else {
            $character_form['image_path'] = $character->image_path;
        }
        
        unset($character_form['image']);
        unset($character_form['remove']);
        unset($character_form['_token']);
        // 該当するデータを上書きして保存する
        $character->fill($character_form)->save();
        
        // CharacterControllerのupdate Actionで、Character Modelを保存するタイミングで
        // 同時にCh_History Modelにも編集履歴を追加するようにする
        $ch_history = new Ch_History();
        
        // dd($ch_history);
        $ch_history->character_id = $character->id;
        $ch_history->edited_at = Carbon::now();
        $ch_history->save();
        
        return redirect('admin/character');
    }
    
    public function delete(Request $request){
        $character = Character::find($request->id);
        
        $character->delete();
        
        return redirect('admin/character/');
    }
}
