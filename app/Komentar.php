<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Komentar extends Model
{
    public static function get_pertanyaan($pertanyaan_id) {
        $data = [];
        $data['pertanyaan'] = DB::table('pertanyaan')->where('id', $pertanyaan_id)->first();
        $data['komentar'] = DB::table('pertanyaan_komen')->where('pertanyaan_id', $pertanyaan_id)->get();
        // user //
        $data['user'] = DB::table('pertanyaan')
                            ->join('users', 'pertanyaan.user_id', '=', 'users.id')
                            ->where('pertanyaan.id', '=', $pertanyaan_id)
                            ->select('users.name', 'users.email')
                            ->first();
        // tags //
        $data['tags'] = DB::table('pertanyaan_tag')
                            ->join('pertanyaan', 'pertanyaan_tag.pertanyaan_id', '=', 'pertanyaan.id')
                            ->join('tags', 'pertanyaan_tag.tag_id', '=', 'tags.id')
                            ->where('pertanyaan_tag.pertanyaan_id', $pertanyaan_id)
                            ->select('tags.tag_name')
                            ->get();
        return $data;
    }

    public static function store($request) {
        if(!in_array($request['tipe_komentar'], ['pertanyaan', 'komentar'])) {
            return false;
        }

        $now = date_create()->format('Y-m-d H:i:s');
        return DB::table($request['tipe_komentar'].'_komen')->insert([
            'pertanyaan_id' => $request['pertanyaan_id'],
            'user_id' => $request['user_id'],
            'isi' => $request['isi'],
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
