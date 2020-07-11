@extends('adminlte.master-top-nav')

@section('page-header')
    <i class="fas fa-comment mr-1"></i> Daftar Pertanyaan
@endsection

@section('content')
<a href="{{ route('pertanyaan.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus-circle mr-1"></i> Buat Pertanyaan Baru
</a>
<br>
@forelse($tanya as $key => $item)
<div class="card card-primary card-outline">
    <div class="card-header">
        <span class="badge badge-info" title="{{ $item->user_email }}">
            <i class="fas fa-user mr-1"></i> {{ $item->user_name }}
        </span> |
        <span class="badge badge-primary" title="Reputasi : {{ $item->user_reputasi ?: 0}}">
            <i class="fas fa-medal mr-1"></i> {{ $item->user_reputasi ?: 0}}
        </span>
        <span class="float-right text-muted">{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</span>
    </div>
    <div class="card-body">
        <div class="post">
            <h5 class="card-title">
                <b>
                    <a href="/jawaban/{{ $item->id }}" title="Jawaban dan Komentar">
                        {{ $item->judul }}
                    </a>
                </b>
            </h5>
            <p class="card-text">
                {!! $item->isi !!}</p>
            </p>
            @foreach ($item->tags as $tag)
                <span class="badge badge-success">{{ $tag->tag_name }}</span>
            @endforeach
        </div>
    </div>
    <div class="card-footer">
        @if ($item->user_id == Auth::user()->id)
        <form action="/pertanyaan/{{$item->id}}" method="post" style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash mr-1"></i> Hapus</button>
          </form>
          <a href="/pertanyaan/{{$item->id}}/edit" class="btn btn-sm btn-danger">edit</a>
        @else
        @endif
        {{-- Proses vote bukan di index pertanyaan mengikuti stackoverflow
        @if ($item->user_id != Auth::user()->id)
            <a href="{{ route('votepertanyaan.up', $item->id) }}" class="btn btn-sm btn-success">
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            </a>
            <a href="{{ route('votepertanyaan.down', $item->id) }}" class="btn btn-sm btn-danger">
                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
            </a>

        @endif
        --}}
        @if ($item->user_id == Auth::user()->id)
            <a href="/pertanyaan/{{$item->id}}/edit" class="btn btn-sm btn-warning">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
        @endif

        {{-- button jawaban dan komentar diganti link judul pertanyaan

        <a href="/jawaban/{{$item->id}}"  class="btn btn-primary btn-sm">Jawaban dan Komentar</a>
        <a href="{{ route('komentar.pertanyaan', $item->id) }}" class="btn btn-primary btn-sm">
            Komentar
        </a>
        --}}
        <div class="float-right">
            <span class="badge badge-warning"><i class="fas fa-vote-yea mr-1"></i> {{ $item->poinvote }} Votes </span>
            <span class="badge badge-success" title="{{ $item->votes['up_users'] }}"><i class="fas fa-chevron-up mr-1"></i> {{ $item->votes['up'] }}</span>
            <span class="badge badge-danger" title="{{ $item->votes['down_users'] }}"><i class="fas fa-chevron-down mr-1"></i> {{ $item->votes['down'] }}</span>
            <span class="badge badge-primary"><i class="fas fa-comments mr-1"></i> {{ $item->komentar_count }} Komentar</span>
        </div>
    </div>
</div>
@empty
<div class="card card-warning card-outline">
    <div class="card-body">
        Belum ada pertanyaan. Silahkan buat baru.
    </div>
</div>
<!-- section -->
@endforelse

@endsection
