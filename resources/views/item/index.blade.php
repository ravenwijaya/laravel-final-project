@extends('adminlte.master')

@section('content')
 
@foreach($tanya as $key => $item)



<div class="card" style="width: 50rem;">
<div class="card-body">
   
<div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ asset('/adminlte/dist/img/user1-128x128.jpg')}}" alt="user image">
                        <span class="username">
                          <a href="#">{{ $item->user_name }}</a>
                      
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                    <hr>
                  </div>
            
                  <h3> {{ $item->judul }}</h3>
                  <p>
                  {{ $item->isi }} 
                  </p>

                <button type="submit" class="btn btn-sm btn-success"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></button> 
                <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-thumbs-down" aria-hidden="false"></i> </button> 
               <form action="/pertanyaan/{{$item->id}}" method="post" style="display: inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
              </form><br><br>
              <button type="button" class="btn btn-primary">Answer</button>
              <button type="button" class="btn btn-primary">Comments</button>

  </div>
</div>
 </div>
@endforeach
@endsection





