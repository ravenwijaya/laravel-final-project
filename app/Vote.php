<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vote extends Model
{
    public static function vote($tipe_post, $tipe_post_id, $user_id, $tipe_vote) {
        if(!in_array($tipe_post, ['pertanyaan', 'komentar'])) {
            return false;
        }

        // cek apakah user_id sudah vote di pertanyaan_id
        $sudah_vote = DB::table($tipe_post.'votes')
            ->where('user_id', $user_id)
            ->where($tipe_post.'_id', $tipe_post_id)
            ->exists();
        if($sudah_vote === false) {
            // belum vote //


            // ambil reputasi user pembuat pertanyaan //
            //$user = DB::table('users')->where('id', $user_id)->first();
            $maker = DB::table('pertanyaan as p')
                        ->join('users as u', 'p.user_id', '=', 'u.id')
                        ->where('p.id', $tipe_post_id)
                        ->select('u.id', 'u.reputasi')
                        ->first();

            $now = date_create()->format('Y-m-d H:i:s');
            $votes = DB::table($tipe_post.'votes')->insert([
                'user_id' => $user_id,
                $tipe_post.'_id' => $tipe_post_id,
                'tipe_vote' => $tipe_vote,
                'created_at' => $now,
                'updated_at' => $now
            ]);
            $reputasi = intval($maker->reputasi);
            if($tipe_vote == 'up') {
                $reputasi += 10;
            } else if($tipe_vote == 'down') {
                $reputasi--;
            }
            $update_reputation = DB::table('users')
                ->where('id', $maker->id)
                ->update([
                    'reputasi' => $reputasi,
                    'updated_at' => $now
                ]);

            return true;
        }

        return false;
    }
}
