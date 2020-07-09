<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vote;

class VoteController extends Controller
{
    public function pertanyaan_up($pertanyaan_id) {
        $status = Vote::vote('pertanyaan', $pertanyaan_id, Auth::user()->id, 'up');
        $msg = new \stdClass();
        if($status) {
            $msg->state = 'success';
            $msg->message = 'Terima kasih sudah vote';
        } else {
            $msg->state = 'error';
            $msg->message = 'Anda sudah vote';
        }

        return redirect()->route('pertanyaan.index')->with('status', $msg);
    }

    public function pertanyaan_down($pertanyaan_id) {
        $status = Vote::vote('pertanyaan', $pertanyaan_id, Auth::user()->id, 'down');
        $msg = new \stdClass();
        if($status) {
            $msg->state = 'success';
            $msg->message = 'Terima kasih sudah vote';
        } else {
            $msg->state = 'error';
            $msg->message = 'Anda sudah vote';
        }

        return redirect()->route('pertanyaan.index')->with('status', $msg);
    }

}
