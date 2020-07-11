@extends('adminlte.master-top-nav')

@section('page-header')
    <i class="fas fa-clipboard mr-1"></i> Daftar Jawaban
@endsection

@section('content')
<a href="{{ route('pertanyaan.index') }}" class="btn btn-secondary mb-3">
    <i class="fas fa-chevron-left mr-1"></i> Kembali
</a>
<div class="card card-primary card-outline">
    <div class="card-header">
        <span class="badge badge-info" title="{{ $tanya->user_email }}">
            <i class="fas fa-user mr-1"></i> {{ $tanya->user_name }}
        </span> |
        <span class="badge badge-primary" title="Reputasi : {{ $tanya->user_reputasi ?: 0}}">
            <i class="fas fa-medal mr-1"></i> {{ $tanya->user_reputasi ?: 0}}
        </span>
        <span class="float-right text-muted">{{ date('d-m-Y H:i:s', strtotime($tanya->created_at)) }}</span>
    </div>
    <div class="card-body">
        <h3> {{ $tanya->judul }}</h3>
        <p class="card-text">{!! $tanya->isi !!}</p>
        @foreach ($tanya->tags as $tag)
            <span class="badge badge-success">{{ $tag->tag_name }}</span>
        @endforeach
        <hr>
        @component('components.comment', [
            'post' => $tanya,
            'komentar' => $komentar,
            'tipe_post' => 'pertanyaan'
        ])
        @endcomponent
    </div>
    <div class="card-footer">
        <div class="float-right">
            <span class="badge badge-success" title="{{ $tanya->votes['up_users'] }}"><i class="fas fa-chevron-up mr-1"></i> {{ $tanya->votes['up'] }}</span>
            <span class="badge badge-danger" title="{{ $tanya->votes['down_users'] }}"><i class="fas fa-chevron-down mr-1"></i> {{ $tanya->votes['down'] }}</span>
        </div>
        <span class="text-muted">{{ $tanya->komentar_count }} komentar</span>
    </div>
 </div>

@if (count($jawab))
    <h3>{{ count($jawab) ?: '' }} Jawaban</h3>
    <hr>
    @foreach ($jawab as $row)
        @if ($row->is_terbaik)
            <div class="card card-success card-outline">
        @elseif($row->poinvote >= 0)
            <div class="card card-secondary card-outline">
        @elseif($row->poinvote < 0)
            <div class="card card-danger card-outline">
        @endif

        <div class="card-header">
            <span class="badge badge-info" title="{{ $row->user_email }}">
                <i class="fas fa-user mr-1"></i> {{ $row->user_name }}
            </span> |
            <span class="badge badge-primary" title="Reputasi : {{ $row->user_reputasi ?: 0}}">
                <i class="fas fa-award mr-1"></i> {{ $row->user_reputasi ?: 0}}
            </span>
            <span class="float-right text-muted">{{ date('d-m-Y H:i:s', strtotime($row->created_at)) }}</span>
        </div>
        <div class="card-body">
            {!! $row->isi !!}
            <hr>
            @component('components.comment', [
                'post' => $row,
                'komentar' => $row->komentar,
                'tipe_post' => 'jawaban'
            ])
            @endcomponent

        </div>
        <div class="card-footer">
            @if ($tanya->user_id == Auth::user()->id)
                @if($tanya->jawaban_terbaik && $tanya->jawaban_terbaik == $row->id)
                    {{-- <i class="fas fa-check-circle"></i> Jawaban Terbaik --}}
                @else
                    @if(!$tanya->jawaban_terbaik)
                        <a href="{{ route('vote.best', $row->id) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-check mr-1"></i> Set Jawaban Terbaik
                        </a>
                    @else
                        &nbsp;
                    @endif
                @endif
            @else
                @if($tanya->jawaban_terbaik && $tanya->jawaban_terbaik == $row->id)
                    {{--
                    <a href="#" class="btn btn-sm btn-success disabled">
                        Set Jawaban Terbaik
                    </a>
                    --}}
                @else
                    &nbsp;
                @endif
            @endif
            <div class="float-right">
                <span class="badge badge-success" title="{{ $row->votes['up_users'] }}"><i class="fas fa-chevron-up mr-1"></i> {{ $row->votes['up'] }}</span>
                <span class="badge badge-danger" title="{{ $row->votes['down_users'] }}"><i class="fas fa-chevron-down mr-1"></i> {{ $row->votes['down'] }}</span>
            </div>
       </div>
    </div>
    @endforeach
@else
    <h3 class="clearfix">Belum ada jawaban</h3>
@endif
<hr>
<form action="{{ route('jawaban.store', $tanya->id) }}" method="POST" class="mb-3">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <div class="form-group">
        <label for="isi">Jawaban Anda</label>
        <textarea class="form-control summernote" placeholder="Isi komentar" id="isi" name="isi" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('pertanyaan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
