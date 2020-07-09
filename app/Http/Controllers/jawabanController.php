<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model Custom
use App\Models\JawabanModel;
use App\Models\PertanyaanModel;

//Model Eloquent
use App\Jawaban;
use App\User;

class JawabanController extends Controller
{
    public function create($id){
      //  dd($id);
        return view('item.formjawaban',compact('id'));
    }

    public function store(Request $request){
    // dd($request);
        $new_jawab = Jawaban::create([
            "isi" => $request["isi"],
            "pertanyaan_id" => $request["pertanyaan_id"],
            "user_id" => $request["user_id"],
            "poinvote" => $request["poinvote"],
        ]);
        
        return redirect('/pertanyaan');
    }

     public function index($id) {
         $jawab = JawabanModel::find_by_id($id);
         $tanya = JawabanModel::find_by_idtanya($id);
      //dd($tanya);
       return view('item.indexjawaban', compact('jawab','tanya'));
     }
  
    // public function show($id){
    //     $jawab = Jawaban::find($id);
    //     // dd($item->tags);
    //     return view('item.show', compact('jawab'));
    // }

    public function edit($id) {
        $jawab = JawabanModel::find_by_ids($id);
        return view('item.editjawaban', compact('jawab'));
    }

    public function update($id, Request $request) {
        // dd($request->all());
        $jawab = JawabanModel::update($id, $request->all());
        return redirect('/pertanyaan');
    }

    public function destroy($id) {
        $deleted = JawabanModel::destroy($id);
        return redirect('/pertanyaan');
    }
}
