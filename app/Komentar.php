<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Komentar extends Model
{
    public static function get_pertanyaan($pertanyaan_id) {
        $data = [];
        $data['pertanyaan'] = DB::table('pertanyaan')->where('id', $pertanyaan_id)->first();
        $data['komentar'] = DB::table('pertanyaan_komen as p')
                    ->join('users as u', 'p.user_id', '=', 'u.id')
                    ->select('p.*', 'u.id as user_id', 'u.name as username', 'u.email as useremail')
                    ->where('pertanyaan_id', $pertanyaan_id)->get();
        // tags //
        $data['tags'] = DB::table('pertanyaan_tag')
                            ->join('pertanyaan', 'pertanyaan_tag.pertanyaan_id', '=', 'pertanyaan.id')
                            ->join('tags', 'pertanyaan_tag.tag_id', '=', 'tags.id')
                            ->where('pertanyaan_tag.pertanyaan_id', $pertanyaan_id)
                            ->select('tags.tag_name')
                            ->get();
        return $data;
    }

    public static function get_jawaban($jawaban_id) {
        $data = [];
        $data['jawaban'] = DB::table('jawaban')->where('id', $jawaban_id)->first();
        $data['komentar'] = DB::table('jawaban_komen as p')
                    ->join('users as u', 'p.user_id', '=', 'u.id')
                    ->select('p.*', 'u.id as user_id', 'u.name as username', 'u.email as useremail')
                    ->where('p.jawaban_id', $jawaban_id)->get();
        // tags //
        $data['tags'] = DB::table('pertanyaan_tag')
                            ->join('pertanyaan', 'pertanyaan_tag.pertanyaan_id', '=', 'pertanyaan.id')
                            ->join('tags', 'pertanyaan_tag.tag_id', '=', 'tags.id')
                            ->where('pertanyaan_tag.pertanyaan_id', $jawaban_id)
                            ->select('tags.tag_name')
                            ->get();
        return $data;
    }

    public static function store($request) {
        if(!in_array($request['tipe_komentar'], ['pertanyaan', 'jawaban'])) {
            return false;
        }
        $now = date_create()->format('Y-m-d H:i:s');
        $table = $request['tipe_komentar'].'_komen';
        $tipe_col = $request['tipe_komentar'].'_id';

        return DB::table($table)->insert([
            $tipe_col => $request[$tipe_col],
            'user_id' => $request['user_id'],
            'isi' => $request['isi'],
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
