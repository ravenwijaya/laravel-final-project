@extends('adminlte.master')

@section('content')
  <div class="ml-3 mt-3">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Pertanyaan</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
     <form role="form" action="/jawaban/{{$jawab->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
         <div class="form-group">
            <label for="id">Id Jawaban</label>
            <input type="text" class="form-control" id="id" value="{{$jawab->id}}" name="id" readonly>
          </div>
          
          <div class="form-group">
            <label for="isi">Isi</label>
            <input type="text" class="form-control" id="isi" value="{{$jawab->isi}}" name="isi" placeholder="isi">
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