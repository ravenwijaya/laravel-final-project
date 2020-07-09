<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class JawabanModel {

    public static function get_all(){
        $jawab = DB::table('jawaban')
                      ->select('jawaban.*', 'users.name as user_name', 'users.id as user_id','users.reputasi as user_reputasi')
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

}
