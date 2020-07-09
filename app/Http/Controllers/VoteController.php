<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vote;

class VoteController extends Controller
{
    public function pertanyaan_up($pertanyaan_id) {
        Vote::vote('pertanyaan', $pertanyaan_id, Auth::user()->id, 'up');

        return redirect()->route('pertanyaan.index');
    }
}
