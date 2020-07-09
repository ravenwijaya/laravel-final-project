@extends('adminlte.master')

@section('content')
  <div class="ml-3 mt-3">
    <h1>Data Pertanyaan</h1>
    <a href="/pertanyaan/create" class="btn btn-primary mb-2">
      Buat Pertanyaan Baru
    </a>
    <table class="table table-bordered">
      <thead>                  
        <tr>
          <th style="width: 10px">#</th>
          <th>Judul</th>
          <th>Isi</th>
          <th>username</th>
      
        </tr>
      </thead>
      <tbody>
        @foreach($tanya as $key => $item)
          <tr>
            <td> {{ $item->id }} </td>
            <td> {{ $item->judul }} </td>
            <td> {{ $item->isi }} </td>
            <td> {{ $item->user_name }} </td>
            
           
            <td>
              <a href="/pertanyaan/{{$item->id}}" class="btn btn-sm btn-info">show</a>
              <a href="/pertanyaan/{{$item->id}}/edit" class="btn btn-sm btn-default">edit</a>
              <form action="/pertanyaan/{{$item->id}}" method="post" style="display: inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection





<div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ asset('/adminlte/dist/img/user1-128x128.jpg')}}" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>


