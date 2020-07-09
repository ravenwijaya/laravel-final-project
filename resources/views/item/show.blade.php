@extends('adminlte.master')

@section('content')
  
<div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a >Detail Pertanyaan</a></li>
                
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="{{ asset('/adminlte/dist/img/user1-128x128.jpg')}}" alt="user image">
                         
                        <span class="username">
                            <h3> {{ $tanya->judul }} </h3>
                  
                        </span>
                        <span class="description">id Pertanyaan: {{ $tanya->id }}</span>
                      </div>
                      <!-- /.user-block -->
                    
                      <p>
                      {!! $tanya->isi !!} 
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                           
      @foreach($tanya->tags as $tag) 
        <button class="btn btn-warning btn-sm"> {{$tag->tag_name}} </button>
      @endforeach
                 
                           
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->

                  </div>

              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
@endsection

