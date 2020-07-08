@extends('adminlte.master')
@section('content')
<table class="table">
    <thead>
      <tr>
        <th>id pertanyaan</th>
        <th>judul pertanyaan</th>
        <th>isi pertanyaan</th>
      </tr>
    </thead>
    <tbody>

     <tr>
     <td>{{$tanyaid->id}}</td>
     <td>{{$tanyaid->judul}}</td>
     <td>{{$tanyaid->isi}}</td>
     </tr>

   
    </tbody>
  </table>

  <table class="table">
    <thead>
      <tr>
        <th>id jawaban</th>
        <th>isi jawaban</th>
        <th>tglbuat</th>
        <th>tgldiperbaharui</th>
      
      </tr>
    </thead>
    <tbody>
   
  
    @foreach($jawab as $key=>$item)
     <tr>
     <td>{{$item->id}}</td>
     <td>{{$item->isi}}</td>
     <td>{{$item->tanggaldibuat}}</td>
     <td>{{$item->tanggaldiperbaharui}}</td>
    
     </tr>
   @endforeach
    </tbody>
  </table>


  <form action="/jawaban/{{$tanyaid->id}}" method="POST">
@csrf

  <div class="form-group">
    <label for="pertanyaan">jawaban:</label>
    <input type="text" class="form-control" name="isi" placeholder="Enter isi" id="isi">
  </div>
  <input type="hidden" name="idpertanyaan" id="idpertanyaan" value= "{{ $tanyaid->id}}"readonly><br>
  <input type="hidden" name="tanggaldibuat" id="tanggaldibuat" value= "{{ date('Y-m-d')}}" readonly><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form> 
  @endsection