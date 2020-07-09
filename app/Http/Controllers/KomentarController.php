<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Komentar;

class KomentarController extends Controller
{
    public function pertanyaan($pertanyaan_id) {
        $data = Komentar::get_pertanyaan($pertanyaan_id);

        return view('komentar.pertanyaan', compact('data'));
    }

    public function jawaban($jawaban_id) {

    }

    public function store(Request $request, $id)
    {
        Komentar::store($request->all());
        return redirect()->route('komentar.pertanyaan', $request['pertanyaan_id']);
    }
}
