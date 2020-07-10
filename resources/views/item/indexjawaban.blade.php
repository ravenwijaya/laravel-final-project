@extends('adminlte.master')

@section('content')
<a href="{{ route('pertanyaan.index') }}" class="btn btn-secondary mb-3 mt-3">Kembali</a>
<div class="card">
    <div class="card-header">
        <span class="badge badge-info">{{ $tanya->user_name }}</span> | {{ $tanya->user_reputasi ?: 0}} reputation
        <span class="float-right text-muted">{{ $tanya->created_at }}</span>
    </div>
    <div class="card-body">
        <div class="post">
            {{--
            <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{ asset('/adminlte/dist/img/user1-128x128.jpg')}}" alt="user image">
                <span class="username">
                    <a href="#">{{ $tanya->user_name }}</a>
                </span>
                <span class="description">Shared publicly - {{$tanya->created_at}}</span>
                <hr>
            </div>
            <a>vote: {{ $tanya->poinvote }}</a>
            --}}
            <h3> {{ $tanya->judul }}</h3>
            <p class="card-text">{!! $tanya->isi !!}</p>
            @foreach ($tanya->tags as $tag)
                <span class="badge badge-info">{{ $tag->tag_name }}</span>
            @endforeach
            <hr>
            <a href="{{ route('votepertanyaan.up', $tanya->id) }}" class="btn btn-sm btn-success {{ $tanya->user_id == Auth::user()->id ? 'disabled' : '' }}">
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            </a>
            <a href="{{ route('votepertanyaan.down', $tanya->id) }}" class="btn btn-sm btn-danger {{ $tanya->user_id == Auth::user()->id ? 'disabled' : '' }}">
                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
            </a>

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
                <form action="{{ route('komentar.store', $tanya->id) }}" method="POST" style="display:">
                    @csrf
                    <input type="hidden" name="tipe_komentar" value="pertanyaan">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="pertanyaan_id" value="{{ $tanya->id }}">
                    <br>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" class="form-control" placeholder="Submit komentar pertanyaan" name="isi">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <span class="float-right text-muted">{{ $tanya->poinvote }} votes | {{ $tanya->komentar_count }} comments</span>
    </div>
 </div>

<h3>{{ count($jawab) ?: '' }} Jawaban</h3>
<hr>
@if (count($jawab))
    @foreach ($jawab as $row)
    <div class="card">
        <div class="card-header">
            <span class="badge badge-info">{{ $row->user_name }}</span> | {{ $row->user_reputasi ?: 0}} reputation
            <span class="float-right text-muted">{{ $row->created_at }}</span>
        </div>
        <div class="card-body">
            {!! $row->isi !!}
            <hr>
            <a href="{{ route('votejawaban.up', $row->id) }}" class="btn btn-sm btn-success {{ $row->user_id == Auth::user()->id ? 'disabled' : '' }}">
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            </a>
            <a href="{{ route('votejawaban.down', $row->id) }}" class="btn btn-sm btn-danger {{ $row->user_id == Auth::user()->id ? 'disabled' : '' }}">
                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
            </a>
            <div class="comment">
                <ol style="display:grid; list-style: none; margin-top: -2.5em" class="ml-5">
                    @forelse ($row->komentar as $i => $comment)
                    <li style="border-bottom: 1px solid rgba(95, 48, 48, 0.1)" class="pb-1">
                        <span>{{ $i+1 }}. {{ $comment->isi }}.&nbsp;&nbsp;</span>
                        <span class="badge badge-info" title="{{ $comment->user_email }}">{{ $comment->user_name }}</span>
                        <span class="badge badge-warning">{{ $comment->created_at }}</span>
                    </li>
                    @empty
                    <li style="border-bottom: 1px solid rgba(95, 48, 48, 0.1)" class="pb-1">
                        <span>Belum ada komentar</span>
                    </li>
                    <br>
                    @endforelse
                </ol>
                <form action="{{ route('komentar.store', $row->id) }}" method="POST" style="display:">
                    @csrf
                    <input type="hidden" name="tipe_komentar" value="jawaban">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="jawaban_id" value="{{ $row->id }}">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" class="form-control" placeholder="Submit komentar jawaban" name="isi">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer">
            @if ($tanya->user_id == Auth::user()->id)
                @if($tanya->jawaban_terbaik && $tanya->jawaban_terbaik == $row->id)
                    <a href="#" class="btn btn-sm btn-success disabled">
                        Jawaban Terbaik
                    </a>
                @else
                    @if(!$tanya->jawaban_terbaik)
                        <a href="{{ route('vote.best', $row->id) }}" class="btn btn-sm btn-success">
                            Jawaban Terbaik
                        </a>
                    @else
                        &nbsp;
                    @endif
                @endif
            @else
                @if($tanya->jawaban_terbaik && $tanya->jawaban_terbaik == $row->id)
                    <a href="#" class="btn btn-sm btn-success disabled">
                        Jawaban Terbaik
                    </a>
                @else
                    &nbsp;
                @endif
            @endif
            <span class="float-right text-muted">{{ $row->poinvote ?: 0 }} votes | {{ count($row->komentar) }} comments</span>
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


{{-- comment dulu gan, pening banget liat tabnya T_T

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








