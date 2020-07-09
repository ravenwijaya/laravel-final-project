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
            $now = date_create()->format('Y-m-d H:i:s');
            $votes = DB::table($tipe_post.'votes')->insert([
                'user_id' => $user_id,
                $tipe_post.'_id' => $tipe_post_id,
                'tipe_vote' => $tipe_vote,
                'created_at' => $now,
                'updated_at' => $now
            ]);
            if($tipe_vote == 'up') {

            } else if($tipe_vote == 'down') {

            }
            $update_reputation = DB::table('users');

            return true;
        }

        return false;
    }
}
