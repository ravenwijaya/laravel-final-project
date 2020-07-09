<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vote extends Model
{
    public static function vote($tipe_post, $tipe_post_id, $user_id, $tipe_vote) {
        if(!in_array($tipe_post, ['pertanyaan', 'jawaban'])) {
            return [
                'state' => 'error',
                'message' => 'Invalid tipe'
            ];
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
            $maker = DB::table($tipe_post.' as p')
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

            return [
                'state' => 'success',
                'message' => 'Terima kasih sudah vote ' . $tipe_post
            ];
        }

        return [
            'state' => 'error',
            'message' => 'Anda sudah pernah vote ' . $tipe_post . ' sebelumnya'
        ];
    }

    public static function best_answer($jawaban_id, $curr_user_id) {
        // cek previous best answer
        if(DB::table('pertanyaan')->where('jawaban_terbaik', $jawaban_id)->exists()) {
            return [
                'state' => 'error',
                'message' => 'Jawaban terbaik telah terpilih sebelumnya'
            ];
        }

        $data = DB::table('jawaban as j')
                    ->select('j.pertanyaan_id', 'u.id as user_id', 'u.reputasi as user_reputasi')
                    ->join('users as u', 'j.user_id', '=', 'u.id')
                    ->where('j.id', $jawaban_id)
                    ->first();

        // cek user vote user yg sama
        if($data->user_id == $curr_user_id) {
            return [
                'state' => 'error',
                'message' => 'User tidak dapat memilih jawaban terbaik milik sendiri'
            ];
        }

        // update tabel pertanyaan //
        $update_pertanyaan = DB::table('pertanyaan')
            ->where('id', $data->pertanyaan_id)
            ->update([
                'jawaban_terbaik' => $jawaban_id
            ]);
        // update reputasi yg punya jawaban //
        $now = date_create()->format('Y-m-d H:i:s');
        $update_user = DB::table('users')
                ->where('id', $data->user_id)
                ->update([
                    'reputasi' => intval($data->user_reputasi) + 15
                ]);

        return [
            'state' => 'success',
            'message' => 'Jawaban terbaik telah disimpan'
        ];
    }
}
