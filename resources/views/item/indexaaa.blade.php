@extends('adminlte.master')

@section('content')
<br>
<a href="{{ route('pertanyaan.create') }}" class="btn btn-primary mb-2">
    Buat Pertanyaan Baru
</a>

@foreach($tanya as $key => $item)

<div class="card" style="width: 50rem;">
<div class="card-body">

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
                  <h3> {{ $item->judul }}</h3>
                  <p>
                  {!! $item->isi !!}
                  </p>

                <button type="submit" class="btn btn-sm btn-success"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-thumbs-down" aria-hidden="false"></i> </button>


                @if ($item->user_id == Auth::user()->id)
                <form action="/pertanyaan/{{$item->id}}" method="post" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
                  </form>
                  <a href="/pertanyaan/{{$item->id}}/edit" class="btn btn-sm btn-danger">edit</a>

            @else
            @endif

                <hr>
                <a href="/jawaban/{{$item->id}}"  class="btn btn-primary">Jawaban</a>
                <button type="button" class="btn btn-primary">Komentar</button>

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
            <button type="submit" class="btn btn-sm btn-danger"> <i class="fa fa-thumbs-down" aria-hidden="false"></i> </button>
            <a href="/jawaban/{{$item->id}}"  class="btn btn-primary btn-sm">Jawab</a>
        @endif
        <a href="{{ route('komentar.pertanyaan', $item->id) }}" class="btn btn-primary btn-sm">
            Komentar
        </a>
    <span class="float-right text-muted">xx reputation - yy comments</span>
    </div>
 </div>
@endforeach

@endsection





