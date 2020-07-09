<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

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
                    ->select('pertanyaan.*', 'users.name as user_name', 'users.id as user_id','users.reputasi as user_reputasi')
                    ->join('users', 'pertanyaan.user_id', '=', 'users.id')
                    ->where('pertanyaan.id',$id)->first();
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
        $jawaban = DB::table('jawaban as j')
                    ->select('j.*', 'u.name as user_name', 'u.email as user_email', 'u.reputasi as user_reputasi')
                    ->join('users as u', 'j.user_id', '=', 'u.id')
                    ->where('j.pertanyaan_id', $id)
                    ->get();

        foreach($jawaban as $i => $item) {
            $komentar = DB::table('jawaban_komen as j')
            ->select('j.*', 'u.name as user_name', 'u.email as user_email', 'u.reputasi as user_reputasi')
                ->join('users as u', 'j.user_id', '=', 'u.id')
                ->where('j.jawaban_id', $item->id)
                ->orderBy('j.created_at')
                ->get();
            if(count($komentar)) {
                $jawaban[$i]->komentar = $komentar;
            } else {
                $jawaban[$i]->komentar = [];
            }
        }
        return $jawaban;
    }
}
