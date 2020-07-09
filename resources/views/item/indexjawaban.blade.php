@extends('adminlte.master')

@section('content')

@if ($tanya->user_id != Auth::user()->id)
<a href="/jawaban/create/{{$tanya->id}}" class="btn btn-primary mb-2">
      Buat Jawaban Baru
    </a>
            @endif



<div class="card" style="width: 70rem;">
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
                  <a >vote: {{ $tanya->poinvote }}</a>
                  <h3> {{ $tanya->judul }}</h3>
                  <p>
                  {!! $tanya->isi !!}
                  </p>
    
                <button type="submit" class="btn btn-sm btn-success"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></button> 
                <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-thumbs-down" aria-hidden="false"></i> </button> 
   
        </div>
    </div>
 </div>



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


@endsection








