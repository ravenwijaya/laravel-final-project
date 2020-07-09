<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model Custom
use App\Models\PertanyaanModel;

//Model Eloquent
use App\Pertanyaan;
use App\Pertanyaanvote;
use App\Models\Tag;
use App\User;

class PertanyaanController extends Controller
{
    public function create(){
        $users = User::all();
       $aa=$users->find(1);
        // $subset = $users->map(function ($user) {
        //     return collect($user->toArray())
        //         ->only(['id', 'name', 'email'])
        //         ->all();
        // });
       //dd( $aa);
        return view('item.form', compact('aa'));
    }

    public function store(Request $request){
     
        $new_tanya = Pertanyaan::create([
            "judul" => $request["judul"],
            "isi" => $request["isi"],
            "user_id" => $request["user_id"],
            "poinvote" => $request["poinvote"],
        ]);

        $tagArr = explode(',', $request->tags);
        $tagsMulti  = [];
        foreach($tagArr as $strTag){
            $tagArrAssc["tag_name"] = $strTag;
            $tagsMulti[] = $tagArrAssc;
        }
        // dd($tagsMulti);
        // Create Tags baru
        foreach($tagsMulti as $tagCheck){
            $tag = Tag::firstOrCreate($tagCheck);
            $new_tanya->tags()->attach($tag->id);
        }
        
        return redirect('/pertanyaan');
    }

    public function index() {
        $tanya = PertanyaanModel::get_all();
        // $users = User::all();
        // $aa=$users->find(1);
        //dd($tanya);
        return view('item.index', compact('tanya'));
    }




    // public function pertanyaanvoteu(Request $request){
    //   //  dd($request);
    //   unset($request["_token"]);
    //     $new_tanya = pertanyaanvote::create([
    //         "user_id" => $request["user_id"],
    //         "pertanyaan_id" => $request["id"],
    //         "tipe_vote" =>"up",
    //     ]);

    //      dd($request);
    //     return redirect('/pertanyaan');
    // }
    
    // public function pertanyaanvoted(Request $request){
     
    //     $new_tanya = Pertanyaanvote::create([
    //         "user_id" => $request["user_id"],
    //         "pertanyaan_id" => $request["pertanyaan_id"],
    //         "tipe_vote" =>"down",
    //     ]);

    //     // dd($tagsMulti);
    //     return redirect('/pertanyaan');
    // }







  
    public function show($id){
        $tanya = Pertanyaan::find($id);
        // dd($item->tags);
        return view('item.show', compact('tanya'));
    }

    public function edit($id) {
        $tanya = PertanyaanModel::find_by_id($id);
        return view('item.edit', compact('tanya'));
    }

    public function update($id, Request $request) {
        // dd($request->all());
        $tanya = PertanyaanModel::update($id, $request->all());
        return redirect('/pertanyaan');
    }

    public function destroy($id) {
        $deleted = PertanyaanModel::destroy($id);
        return redirect('/pertanyaan');
    }
}
