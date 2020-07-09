<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pertanyaan extends Model
{
    //
    protected $table="pertanyaan";

    protected $guarded = [];

    public function users() {
        return $this->belongsTo('App\User');
    }
    public function tags() {
        return $this->belongsToMany('App\Models\Tag', 'pertanyaan_tag', 'pertanyaan_id', 'tag_id');
    }

    public function komentar() {
        //return $this->HasMany('App\Komentar');
    }
}
