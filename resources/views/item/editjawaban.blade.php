@extends('adminlte.master-top-nav')

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
          <input type="hidden" class="form-control" id="pertanyaan_id" value="{{$jawab->pertanyaan_id}}" name="pertanyaan_id" readonly>
          <div class="form-group">
            <label for="isi">Isi</label>
            <textarea class="form-control summernote" id="isi" name="isi" placeholder="Isi jawaban">{!!$jawab->isi!!}</textarea>
          </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="/jawaban/{{$jawab->id}}" class="btn btn-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>
@endsection
