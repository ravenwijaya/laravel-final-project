<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaanvote extends Model
{
 //
 protected $table="pertanyaanvotes";

 protected $guarded = [];

// public function users() {
//     return $this->belongsTo('App\User');
// }
//  public function tags() {
//      return $this->belongsToMany('App\Models\Tag', 'pertanyaan_tag', 'pertanyaan_id', 'tag_id');
//  }
}
