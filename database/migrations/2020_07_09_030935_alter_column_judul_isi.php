<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnJudulIsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->text('judul')->change();
            $table->text('isi')->change();
        });
        Schema::table('jawaban', function (Blueprint $table) {
            $table->text('isi')->change();
        });
        Schema::table('pertanyaan_komen', function (Blueprint $table) {
            $table->text('isi')->change();
        });
        Schema::table('jawaban_komen', function (Blueprint $table) {
            $table->text('isi')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->string('judul', 191)->change();
            $table->string('isi', 191)->change();
        });
        Schema::table('jawaban', function (Blueprint $table) {
            $table->string('isi', 191)->change();
        });
        Schema::table('pertanyaan_komen', function (Blueprint $table) {
            $table->string('isi', 191)->change();
        });
        Schema::table('jawaban_komen', function (Blueprint $table) {
            $table->string('isi', 191)->change();
        });
    }
}
