<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColTypeVoteInPertanyaanvoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pertanyaanvotes', function (Blueprint $table) {
            $table->enum('tipe_vote', ['up', 'down']);
        });
        Schema::table('jawabanvotes', function (Blueprint $table) {
            $table->enum('tipe_vote', ['up', 'down']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pertanyaanvotes', function (Blueprint $table) {
            $table->dropColumn('tipe_vote');
        });
        Schema::table('jawabanvotes', function (Blueprint $table) {
            $table->dropColumn('tipe_vote');
        });
    }
}
