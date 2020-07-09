@extends('adminlte.master')

@section('content')
<br>
<div class="card">
    <div class="card-body">
        <div class="post">
            <h3>{{ $data['pertanyaan']->judul }}</h3>
            <small>
                Asked {{ $data['pertanyaan']->updated_at }}
            </small>
            <hr>
            {!! $data['pertanyaan']->isi !!}
            <br>
            @foreach ($data['tags'] as $tag)
                <span class="badge badge-success">{{ $tag->tag_name }}</span>
            @endforeach
            <hr>
            <div class="comment small">
                @forelse ($data['komentar'] as $i => $item)
                    {{ $i+1 }}. {{ $item->isi }}.&nbsp;&nbsp;
                    <span class="badge badge-info">{{ $data['user']->name }}</span>
                    {{ $item->created_at }}
                @empty
                    <small>Belum ada komentar.</small>
                @endforelse
                </table>
            </div>
            <hr>
            <form action="/komentar_pertanyaan/{{ $data['pertanyaan']->id }}" method="POST">
                <input type="hidden" name="pertanyaan_id" value="{{ $data['pertanyaan']->id }}" />
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="tipe_komentar" value="pertanyaan">
                @csrf
                <div class="form-group">
                    <label for="isi">Tambah Komentar</label>
                    <textarea class="form-control" placeholder="Isi komentar" id="isi" name="isi" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('pertanyaan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>
@endsection
