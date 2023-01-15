<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     // Migratonの実行時のコードを記述
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id(); // 新規作成される際に自動で生成される
            $table->string('title'); // ニュースのタイトルを保存するかラム
            $table->string('body'); // ニュースの本文を保存するカラム
            $table->string('image_path')->nullable(); // 画像のパスを保存するカラム。nullable(); でパスがからでも保存できるようにする。
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     //Migrationの取り消しを行うためのコードを記述
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
