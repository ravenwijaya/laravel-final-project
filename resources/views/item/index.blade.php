@extends('adminlte.master')

@section('content')
<br>
<a href="{{ route('pertanyaan.create') }}" class="btn btn-primary mb-2">
    Buat Pertanyaan Baru
</a>

@foreach($tanya as $key => $item)

<div class="card">
    <div class="card-body">
        <div class="post">
            <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{ asset('/adminlte/dist/img/user1-128x128.jpg')}}" alt="user image">
                <span class="username">
                    <a href="#">{{ $item->user_name }}</a>
                </span>
                <span class="description">{{ $item->user_reputasi }} Reputation | Shared - {{$item->created_at}}</span>
                <hr>
            </div>
            <h5 class="card-title">
                <b><a href="{{ route('pertanyaan.show', $item->id) }}">{{ $item->judul }}</a></b>
            </h5>
            <p class="card-text">
                {!! $item->isi !!}</p>
            </p>
        </div>
    </div>
    <div class="card-footer">
        @if ($item->user_id == Auth::user()->id)
        <form action="/pertanyaan/{{$item->id}}" method="post" style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
          </form>
        @else
        @endif
        <!-- pembuat pertanyaan tidak dapat membuat jawaban sendiri -->
        @if ($item->user_id != Auth::user()->id)
            <a href="{{ route('votepertanyaan.up', $item->id) }}" class="btn btn-sm btn-success">
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            </a>
            <a href="{{ route('votepertanyaan.down', $item->id) }}" class="btn btn-sm btn-danger">
                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
            </a>
            <a href="/jawaban/{{$item->id}}"  class="btn btn-primary btn-sm">Jawab</a>
        @endif
        <a href="{{ route('komentar.pertanyaan', $item->id) }}" class="btn btn-primary btn-sm">
            Komentar
        </a>
    <span class="float-right text-muted">xx votes - yy comments</span>
    </div>
 </div>
@endforeach

@endsection





