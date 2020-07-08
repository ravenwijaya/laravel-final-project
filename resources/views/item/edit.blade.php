@extends('adminlte.master')
@section('content')
<div class="card-header">
                <h3 class="card-title">Edit pertanyaan</h3>
              </div>
<form action="/pertanyaan/{{$tanya->id}}" method="POST">
                <div class="card-body">
                @csrf
                @method('PUT')

                  <div class="form-group">
                    <label for="email">judul</label>
                    <input type="text" class="form-control" name="judul" placeholder="Enter judul" id="judul"value="{{$tanya->judul}}">
                  </div>
                
                  <div class="form-group">
                    <label for="pertanyaan">Isi</label>
                    <input type="text" class="form-control" name="isi" placeholder="Enter isi" id="isi"value="{{$tanya->isi}}">
                  </div>
                  
                  <input type="hidden" name="tanggaldiperbaharui" id="tanggaldiperbaharui" value= {{ date('Y-m-d') }} readonly><br>
               
                 
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
@endsection

