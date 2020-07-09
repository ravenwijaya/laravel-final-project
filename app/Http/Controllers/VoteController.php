<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vote;

class VoteController extends Controller
{
    public function pertanyaan_up($pertanyaan_id) {
        $status = Vote::vote('pertanyaan', $pertanyaan_id, Auth::user()->id, 'up');

        return redirect()->back()->with('status', $status);
    }

    public function pertanyaan_down($pertanyaan_id) {
        $status = Vote::vote('pertanyaan', $pertanyaan_id, Auth::user()->id, 'down');

        return redirect()->back()->with('status', $status);
    }

    public function jawaban_up($pertanyaan_id) {
        $status = Vote::vote('jawaban', $pertanyaan_id, Auth::user()->id, 'up');

        return redirect()->back()->with('status', $status);
    }

    public function jawaban_down($pertanyaan_id) {
        $status = Vote::vote('jawaban', $pertanyaan_id, Auth::user()->id, 'down');

        return redirect()->back()->with('status', $status);
    }

    public function best_answer($jawaban_id) {
        $status = Vote::best_answer($jawaban_id, Auth::user()->id);

        return redirect()->back()->with('status', $status);
    }
}
