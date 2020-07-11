<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class JawabanModel {

    public static function get_all(){
        $jawab = DB::table('jawaban')
                      ->select('jawaban.*', 'users.name as user_name', 'users.id as user_id','users.reputasi as user_reputasi', 'users.email as user_email')
                      ->join('users', 'jawaban.user_id', '=', 'users.id')
                      ->get();
        return $jawab;
      }

//   public static function save($data){
//       $new_tanya=DB::table('tanya')->insert($data);
//       return $new_tanya;
//   }
public static function find_by_ids($id){
    $jawab=DB::table('jawaban')->where('id',$id)->first();
    return $jawab;
}
  public static function find_by_id($id){
    $jawab=DB::table('jawaban')
                    ->select('jawaban.*', 'users.name as user_name', 'users.id as user_id','users.reputasi as user_reputasi')
                    ->join('users', 'jawaban.user_id', '=', 'users.id')
                    ->where('pertanyaan_id',$id)->get();
      return $jawab;
  }
  public static function find_by_idtanya($id){
    $tanya = DB::table('pertanyaan')
                    ->select('pertanyaan.*', 'users.name as user_name', 'users.id as user_id','users.reputasi as user_reputasi', 'users.email as user_email')
                    ->join('users', 'pertanyaan.user_id', '=', 'users.id')
                    ->where('pertanyaan.id',$id)->first();
    // tempelkan tag
        $tags = DB::table('pertanyaan_tag as pt')
                    ->select('t.tag_name')
                    ->join('tags as t', 't.id', '=', 'pt.tag_id')
                    ->where('pt.pertanyaan_id', $tanya->id)
                    ->get();
        $tanya->tags = $tags;

        // tempel count komentar
        $comments = DB::table('pertanyaan_komen')
                    ->where('pertanyaan_id', $tanya->id)
                    ->count();
        $tanya->komentar_count = $comments;

        // tempel data vote
        $votes = DB::table('pertanyaanvotes as v')
            ->select('v.*', 'u.id as user_id','u.name as user_name', 'u.email as user_email', 'u.reputasi as user_reputasi')
            ->join('users as u', 'v.user_id', '=', 'u.id')
            ->where('v.pertanyaan_id', $tanya->id)
            ->get();

        $user_vote_up = $user_vote_down = [];
        $num_vote_up = $num_vote_down = 0;
        $users_id_vote = [];
        foreach($votes as $v) {
            if($v->tipe_vote == 'up') {
                $user_vote_up[] = $v->user_name;
                $num_vote_up++;
                $users_id_vote[] = $v->user_id;
            } else if($v->tipe_vote == 'down') {
                $user_vote_down[] = $v->user_name;
                $num_vote_down++;
                $users_id_vote[] = $v->user_id;
            }
        }

        $vote_info = [
            'up' => $num_vote_up,
            'up_users' => implode(', ', $user_vote_up),
            'down' => $num_vote_down,
            'down_users' => implode(',', $user_vote_down),
            'vote_users_id' => json_encode($users_id_vote)
        ];

        count($vote_info) ? $tanya->votes = $vote_info : $tanya->votes = [];

        return $tanya;
  }
  public static function update($id, $request){
     // dd($request);
     $jawab=DB::table('jawaban')
                 ->where('id',$id)
                 ->update([
                     'isi'=>$request['isi'],

                     ]);
      return $jawab;
  }
  public static function destroy($id){
      // dd($request);
      $jawab=DB::table('jawaban')
                  ->where('id',$id)
                  ->delete();
       return $jawab;
   }

   public static function new_jawaban($request, $id) {
        $now = date_create()->format('Y-m-d H:i:s');
        return DB::table('jawaban')->insert([
            'isi' => $request['isi'],
            'pertanyaan_id' => $id,
            'user_id' => $request['user_id'],
            'created_at' => $now,
            'updated_at' => $now
        ]);
   }

   public static function jawaban_komentar($id) {
        // loop jawaban sesuai pertanyaan_id //
        // order by jawaban terbaik, poinvote, updated_at
        $jawaban = DB::table('jawaban as j')
                    ->select('j.*', 'u.name as user_name', 'u.email as user_email', 'u.reputasi as user_reputasi')
                    ->join('users as u', 'j.user_id', '=', 'u.id')
                    ->where('j.pertanyaan_id', $id)
                    ->orderBy('j.is_terbaik', 'desc')
                    ->orderBy('j.poinvote', 'desc')
                    ->orderBy('j.updated_at')
                    ->get();

        foreach($jawaban as $i => $item) {
            // tempel data komentar
            $komentar = DB::table('jawaban_komen as j')
                ->select('j.*', 'u.name as user_name', 'u.email as user_email', 'u.reputasi as user_reputasi')
                ->join('users as u', 'j.user_id', '=', 'u.id')
                ->where('j.jawaban_id', $item->id)
                ->orderBy('j.created_at')
                ->get();

            count($komentar) ? $jawaban[$i]->komentar = $komentar : $jawaban[$i]->komentar = [];

            // tempel data vote
            $votes_up = DB::table('jawabanvotes as v')
                ->select('v.*', 'u.id as user_id', 'u.name as user_name', 'u.email as user_email', 'u.reputasi as user_reputasi')
                ->join('users as u', 'v.user_id', '=', 'u.id')
                ->where('v.jawaban_id', $item->id)
                ->where('v.tipe_vote', 'up')
                ->get();
            $votes_down = DB::table('jawabanvotes as v')
                ->select('v.*', 'u.id as user_id', 'u.name as user_name', 'u.email as user_email', 'u.reputasi as user_reputasi')
                ->join('users as u', 'v.user_id', '=', 'u.id')
                ->where('v.jawaban_id', $item->id)
                ->where('v.tipe_vote', 'down')
                ->get();

            $user_vote_up = $user_vote_down = [];
            $users_id_vote = [];
            foreach($votes_up as $v) {
                $user_vote_up[] = $v->user_name;
                $users_id_vote[] = $v->user_id;
            }
            foreach($votes_down as $v) {
                $user_vote_down[] = $v->user_name;
                $users_id_vote[] = $v->user_id;
            }

            $vote_info = [
                'up' => count($votes_up),
                'up_users' => implode(', ', $user_vote_up),
                'down' => count($votes_down),
                'down_users' => implode(',', $user_vote_down),
                'vote_users_id' => json_encode($users_id_vote)
            ];

            count($vote_info) ? $jawaban[$i]->votes = $vote_info : $jawaban[$i]->votes = [];
        }
        return $jawaban;
    }
}
