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
                <span class="description">Shared publicly - {{$item->created_at}}</span>
                <hr>
            </div>
            <a >vote: {{ $item->poinvote }}</a>
            <h3><a href="{{ route('pertanyaan.show', $item->id) }}">{{ $item->judul }}</a></h3>
            <p class="isi">{!! $item->isi !!}</p>
            <!--
            <button type="submit" class="btn btn-sm btn-success"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-thumbs-down" aria-hidden="false"></i> </button>
            -->
            @if ($item->user_id == Auth::user()->id)
                <form action="/pertanyaan/{{$item->id}}" method="post" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
                  </form>
            @else
            @endif
            <!-- pembuat pertanyaan tidak dapat membuat jawaban dan komentarnya sendiri -->
            @if ($item->user_id != Auth::user()->id)
                <hr>
                <a href="/jawaban/{{$item->id}}"  class="btn btn-primary">Jawab</a>
                <button type="button" class="btn btn-primary">Komentari</button>
            @endif
        </div>
    </div>
 </div>
@endforeach

@endsection





