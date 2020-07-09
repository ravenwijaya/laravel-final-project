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
    public function create(){
        return view('item.formjawaban');
    }

    // public function store(Request $request){
     
    //     $new_jawab = Jawaban::create([
    //         "isi" => $request["isi"],
    //         "pertanyaan_id" => $request["pertanyaan_id"],
    //         "user_id" => $request["user_id"],
    //         "poinvote" => $request["poinvote"],
    //     ]);
        
    //     return redirect('/jawaban');
    // }

     public function index() {
         $tanya = PertanyaanModel::get_all();
         $jawab = JawabanModel::get_all();
       return view('item.indexjawaban', compact('jawab','tanya'));
     }
  
    // public function show($id){
    //     $jawab = Jawaban::find($id);
    //     // dd($item->tags);
    //     return view('item.show', compact('jawab'));
    // }

    // public function edit($id) {
    //     $jawab = JawabanModel::find_by_id($id);
    //     return view('item.editjawaban', compact('jawab'));
    // }

    // public function update($id, Request $request) {
    //     // dd($request->all());
    //     $jawab = JawabanModel::update($id, $request->all());
    //     return redirect('/pertanyaan');
    // }

    // public function destroy($id) {
    //     $deleted = JawabanModel::destroy($id);
    //     return redirect('/pertanyaan');
    // }
}
