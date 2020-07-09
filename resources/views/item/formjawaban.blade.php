@extends('adminlte.master')

@section('content')
  <div class="ml-3 mt-3">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Jawaban Baru</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" action="/jawaban/{{$id}}"  method="POST">
        @csrf
        <div class="card-body">
    
            <input type="hidden" class="form-control" id="user_id" value=" {{Auth::user()->id}}" name="user_id" readonly>
            <input type="hidden" class="form-control" id="poinvote" value=0 name="poinvote" readonly>
            <input type="hidden" class="form-control" id="pertanyaan_id" value={{$id}} name="pertanyaan_id" readonly>
  
          <div class="form-group">
            <label for="isi">Isi</label>
            <textarea class="form-control summernote" id="isi" name="isi" placeholder="Isi pertanyaan"></textarea>
          </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="/jawaban/{{$id}}" class="btn btn-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>

@endsection
