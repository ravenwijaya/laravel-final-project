<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('isi');
            $table->unsignedBigInteger('pertanyaan_id')->nullable();
<<<<<<< Updated upstream
            $table->unsignedBigInteger('user_id');
            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaan');
            $table->foreign('user_id')->references('id')->on('users');
=======
            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaan')->onDelete('cascade'); 
>>>>>>> Stashed changes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban');
    }
}
