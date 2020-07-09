@extends('adminlte.master')

@section('content')

@if ($tanya->user_id != Auth::user()->id)
    <a href="/jawaban/create/{{$tanya->id}}" class="btn btn-primary mb-3 mt-3">
        Buat Jawaban Baru
    </a>
    <a href="{{ route('pertanyaan.index') }}" class="btn btn-secondary">Kembali</a>
@endif



<div class="card">
    <div class="card-body">
        <div class="post">
            <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{ asset('/adminlte/dist/img/user1-128x128.jpg')}}" alt="user image">
                <span class="username">
                    <a href="#">{{ $tanya->user_name }}</a>
                </span>
                <span class="description">Shared publicly - {{$tanya->created_at}}</span>
                <hr>
            </div>
            <a>vote: {{ $tanya->poinvote }}</a>
            <h3> {{ $tanya->judul }}</h3>
            <p class="card-text">{!! $tanya->isi !!}</p>
            <hr>
            <button type="submit" class="btn btn-sm btn-success"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-thumbs-down" aria-hidden="false"></i> </button>
            <div class="comment">
                <ol style="display:grid; list-style: none; margin-top: -2.5em" class="ml-5">
                @forelse ($komentar as $i => $comment)
                <li style="border-bottom: 1px solid rgba(95, 48, 48, 0.1)" class="pb-1">
                    <span>{{ $i+1 }}. {{ $comment->isi }}.&nbsp;&nbsp;</span>
                    <span class="badge badge-info" title="{{ $comment->email }}">{{ $comment->name }}</span>
                    <span class="badge badge-warning">{{ $comment->created_at }}</span>
                </li>
                @empty
                @endforelse
                </ol>
                <!--
                <ol style="display:grid; list-style: none; margin-top: -2.5em" class="ml-5">
                    <li style="border-bottom: 1px solid rgba(95, 48, 48, 0.1)"><span><small class="text-muted">Last updated 3 mins ago Last updated 3 mins ago Last updated 3 mins ago Last updated 3 mins ago Last updated 3 mins agoLast updated 3 mins agoLast updated 3 mins ago Last updated 3 mins agoLast updated 3 mins ago Last updated 3 mins ago Last updated 3 mins agoLast updated 3 mins ago</small></span></li>
                    <li style="border-bottom: 1px solid rgba(95, 48, 48, 0.1)"><span><small class="text-muted">Last updated 3 mins ago Last updated 3 mins ago Last updated 3 mins ago Last updated 3 mins ago Last updated 3 mins agoLast updated 3 mins agoLast updated 3 mins ago Last updated 3 mins agoLast updated 3 mins ago Last updated 3 mins ago Last updated 3 mins agoLast updated 3 mins ago</small></span></li>
                    <li style="border-bottom: 1px solid rgba(95, 48, 48, 0.1)"><span><small class="text-muted">Last updated 3 mins ago Last updated 3 mins ago Last updated 3 mins ago Last updated 3 mins ago Last updated 3 mins agoLast updated 3 mins agoLast updated 3 mins ago Last updated 3 mins agoLast updated 3 mins ago Last updated 3 mins ago Last updated 3 mins agoLast updated 3 mins ago</small></span></li>
                </ol>
            -->
            </div>
        </div>
    </div>
 </div>

<h3>{{ count($jawab) ?: '' }} Jawaban</h3>
<hr>
@if (count($jawab))
    @foreach ($jawab as $row)
    <div class="card">
        <div class="card-header small">
            {{ $row->user_name }} | {{ $row->user_reputasi}} reputation
            <span class="float-right text-muted">{{ $row->created_at }}</span>
        </div>
        <div class="card-body">
            {!! $row->isi !!}
        </div>
        <div class="card-footer">
            @if ($row->user_id != Auth::user()->id)
                <a href="{{ route('votejawaban.up', $row->id) }}" class="btn btn-sm btn-success">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                </a>
                <a href="{{ route('votejawaban.down', $row->id) }}" class="btn btn-sm btn-danger">
                    <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                </a>
                <a href="/jawaban/{{$row->id}}"  class="btn btn-primary btn-sm">Komentar</a>
            @endif
            @if ($tanya->user_id == Auth::user()->id)
                <a href="/jawaban/{{$row->id}}"  class="btn bg-info btn-sm">Jawaban Terbaik</a>
            @endif
        </div>
    </div>
    @endforeach
@else
    Belum ada jawaban
@endif
<hr>
<form action="{{ route('jawaban.store', $tanya->id) }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <div class="form-group">
        <label for="isi">Jawaban Anda</label>
        <textarea class="form-control summernote" placeholder="Isi komentar" id="isi" name="isi" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('pertanyaan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
<hr>
{{-- comment dulu pening liat tabnya

@foreach($jawab as $key => $item)

<div class="card " style="width: 50rem;">
        <div class="card-body ">
                <div class="post">
                                <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="{{ asset('/adminlte/dist/img/user1-128x128.jpg')}}" alt="user image">
                        <span class="username">
                                        <a href="#">{{ $item->user_name }}</a>
                                      </span>
                                      <span class="description">Shared publicly - {{$item->created_at}}</span>
                                      <hr>
                                  </div>
                          <a >vote: {{ $item->poinvote }}</a>
                          <p>{!! $item->isi !!}</p>
                          <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-success"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                                <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-thumbs-down" aria-hidden="false"></i> </button>

                                @if ($item->user_id == Auth::user()->id)
                            <form action="/jawaban/{{$item->id}}" method="post" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
                            </form>
                              <a href="/jawaban/{{$item->id}}/edit" class="btn btn-sm btn-danger">edit</a>
                                @else
                                @endif
                                <a href="" class="btn btn-primary btn-sm">Komentar </a>
                                <span class="float-right text-muted">xx reputation - yy comments</span>

                      </div>
                  </div>
          </div>
 </div>

@endforeach
--}}

@endsection








