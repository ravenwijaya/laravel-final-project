@extends('adminlte.master')
@section('content')
<div class="card-header">
                <h3 class="card-title">Buat Pertanyaan</h3>
              </div>
<form action="/pertanyaan" method="POST">
                <div class="card-body">
                @csrf
                  <div class="form-group">
                    <label for="email">judul:</label>
                    <input type="text" class="form-control" name="judul" placeholder="Enter judul" id="judul">
                  </div>
                
                  <div class="form-group">
                    <label for="pertanyaan">Isi:</label>
                    <input type="text" class="form-control" name="isi" placeholder="Enter isi" id="isi">
                  </div>
                  
                  <input type="hidden" name="tanggaldibuat" id="tanggaldibuat" value= {{ date('Y-m-d') }} readonly><br>
               
                 
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
@endsection

