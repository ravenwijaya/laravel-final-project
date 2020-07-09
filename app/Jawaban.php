<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{protected $table="jawaban";

    protected $guarded = [];

    public function users() {
        return $this->belongsTo('App\User');
    }
    public function pertanyaan() {
        return $this->belongsTo('App\Pertanyaan');
    }

}
