<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class PertanyaanModel {

    public static function get_all(){
        $tanya = DB::table('pertanyaan')
                      ->select('pertanyaan.*', 'users.name as user_name', 'users.id as user_id','users.reputasi as user_reputasi')
                      ->join('users', 'pertanyaan.user_id', '=', 'users.id')
                      ->get();
        return $tanya;
      }

//   public static function save($data){
//       $new_tanya=DB::table('tanya')->insert($data);
//       return $new_tanya;
//   }
  public static function find_by_id($id){
      $tanya=DB::table('pertanyaan')->where('id',$id)->first();
      return $tanya;
  }
  public static function update($id, $request){
     // dd($request);
      $tanya=DB::table('pertanyaan')
                 ->where('id',$id)
                 ->update([
                     'judul'=>$request['judul'],
                     'isi'=>$request['isi'],

                     ]);
      return $tanya;
  }
  public static function destroy($id){
      // dd($request);
       $tanya=DB::table('pertanyaan')
                  ->where('id',$id)
                  ->delete();
       return $tanya;
   }

   public static function pertanyaan_komentar($id) {
        return DB::table('pertanyaan_komen as p')
                 ->select('p.*', 'u.name', 'u.email')
                 ->join('users as u', 'p.user_id', '=', 'u.id')
                 ->where('p.pertanyaan_id', $id)
                 ->orderBy('p.created_at')
                 ->get();
    }

}
