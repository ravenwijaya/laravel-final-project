@extends('adminlte.master')

@section('content')
  <div class="ml-3 mt-3">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Pertanyaan</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
     <form role="form" action="/pertanyaan/{{$tanya->id}}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="card-body">
         <div class="form-group">
            <label for="id">Id Pertanyaan</label>
            <input type="text" class="form-control" id="id" value="{{$tanya->id}}" name="id" readonly>
          </div>
          <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" value="{{$tanya->judul}}" name="judul" placeholder="Enter Judul ">
          </div>
 
          <div class="form-group">
            <label for="isi">Isi</label>
            <textarea class="form-control summernote" id="isi" name="isi" placeholder="Isi pertanyaan">{!!$tanya->isi!!}</textarea>
          </div>  
         
      
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
@endsection