@extends('adminlte.master')

@section('content')
  <div class="ml-3 mt-3">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Pertanyaan Baru</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" action="/pertanyaan" method="POST">
        @csrf
        <div class="card-body">

            <input type="hidden" class="form-control" id="user_id" value=" {{Auth::user()->id}}" name="user_id" readonly>

          <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Enter judul">
          </div>
          <div class="form-group">
            <label for="isi">Isi</label>
            <textarea class="form-control summernote" id="isi" name="isi" placeholder="Isi pertanyaan"></textarea>
          </div>

          <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" placeholder="tags">
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>

@endsection
