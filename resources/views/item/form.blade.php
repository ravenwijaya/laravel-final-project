@extends('adminlte.master-top-nav')

@section('content')
  <div class="ml-3">
    <div class="card card-primary" style="width: 100%">
      <div class="card-header">
        <h3 class="card-title">Pertanyaan Baru</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" action="/pertanyaanc" method="POST">
        @csrf
        <div class="card-body">

            <input type="hidden" class="form-control" id="user_id" value=" {{Auth::user()->id}}" name="user_id" readonly>
            <input type="hidden" class="form-control" id="poinvote" value=0 name="poinvote" readonly>
          <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul pertanyaan">
          </div>
          <div class="form-group">
            <label for="isi">Isi</label>
            <textarea class="form-control summernote" id="isi" name="isi" placeholder="Isi pertanyaan"></textarea>
          </div>

          <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" placeholder="Beri tanda koma untuk banyak tag, misal : php,css,html">
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{ route('pertanyaan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>

@endsection
