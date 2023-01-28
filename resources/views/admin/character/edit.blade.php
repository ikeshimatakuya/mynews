@extends('layouts.admin')
@section('name', 'キャラクターの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>キャラクターの編集</h2>
                <form action="{{ route('admin.character.update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="ch_name">名前</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="ch_name" value="{{ $character_form->ch_name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="ch_introduction">キャラクター紹介欄</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="ch_introduction" rows="20">{{ $character_form->ch_introduction }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $character_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $character_form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <!--編集履歴を追記 -->
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($character_form->ch_histories != NULL)
                                <!-- NULLでない場合のみforeach文を回す-->
                                @foreach ($character_form->ch_histories as $ch_history)
                                    <li class="list-group-item">{{ $character->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <!---->
            </div>
        </div>
    </div>
@endsection