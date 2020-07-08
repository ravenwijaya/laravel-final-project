<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    public function pertanyaan() {
        return $this->belongsTo('App\Pertanyaan');
    }

    public function insert($request, $user_id) {
        $new_jawaban = new Jawaban;
        $new_jawaban->isi = $request['isi'];
        $new_jawaban->pertanyaan_id = $request['pertanyaan_id'];
        $new_jawaban->user_id = $user_id;

        return $new_jawaban->save();
    }
}
