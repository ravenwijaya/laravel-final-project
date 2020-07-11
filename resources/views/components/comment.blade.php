<table class="table table-borderless table-sm">
    <tr>
        <td class="text-center" style="width: 5%">
            @if (isset($post->votes['vote_users_id']) && $post->votes['vote_users_id'] && in_array(Auth::user()->id, json_decode($post->votes['vote_users_id'], true)))
                <a href="{{ route('vote'.$tipe_post.'.up', $post->id) }}" class="btn btn-sm btn-warning mb-1 disabled" title="Anda telah vote sebelumnya">
                    <i class="fas fa-chevron-up" aria-hidden="true"></i>
                </a>
                <br>
                <span class="text-muted">{{ $post->poinvote ?? 0 }}</span>
                <br>
                <a href="{{ route('vote'.$tipe_post.'.down', $post->id) }}" class="btn btn-sm btn-warning mt-1 disabled" title="Anda telah vote sebelumnya">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </a>
            @else
                <a href="{{ route('vote'.$tipe_post.'.up', $post->id) }}" class="btn btn-sm btn-warning {{ $post->user_id == Auth::user()->id ? 'disabled' : '' }} mb-1" title="Vote Up / Cendol">
                    <i class="fas fa-chevron-up" aria-hidden="true"></i>
                </a>
                <br>
                <span class="text-muted">{{ $post->poinvote ?? 0 }}</span>
                <br>
                <a href="{{ route('vote'.$tipe_post.'.down', $post->id) }}" class="btn btn-sm btn-warning {{ $post->user_id == Auth::user()->id ? 'disabled' : '' }} mt-1" title="Vote Down / Bata">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </a>
            @endif
            @if (isset($post->is_terbaik) && $post->is_terbaik)
                <br><br>
                <span style="color: green">
                <i class="fas fa-check" style="font-size: 200%"></i>
                </span>
            @endif
        </td>
        <td class="pl-4">
            <table class="table table-borderless table-sm table-striped table-hover small" style="margin-top: -5px">
                <tbody>
                    @forelse ($komentar as $i => $comment)
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.1)">
                        <td>{{ $i+1}}.</td>
                        <td width="90%">{{ $comment->isi}}</td>
                        <td>
                            <span class="badge badge-info" title="{{ $comment->user_email }}">
                                <i class="fas fa-user mr-1"></i> {{ $comment->user_name }}
                            </span>
                        </td>
                        <td class="text-nowrap">
                            {{ date('d-m-Y H:i:s', strtotime($comment->created_at)) }}
                        </td>
                        {{-- TO DO
                        <td class="text-nowrap">
                            @if (Auth::user()->id == $comment->user_id)
                                <a href="#" class="badge badge-warning edit-comment"><i class="fas fa-edit"></i></a>
                                <a href="#" class="badge badge-danger hapus-comment"><i class="fas fa-times"></i></a>
                            @else
                                &nbsp;
                            @endif
                        </td>
                        --}}
                    </tr>
                    @empty
                    <tr><td>Tidak ada komentar</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <form action="{{ route('komentar.store', $post->id) }}" method="POST" style="display:">
                                @csrf
                                <input type="hidden" name="tipe_komentar" value="{{ $tipe_post }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="{{ $tipe_post }}_id" value="{{ $post->id }}">
                                <br>
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" class="form-control" placeholder="Submit komentar {{ $tipe_post }}" name="isi">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </td>
    </tr>
</table>

@push('js')
<script>
$('.edit-comment').click(function(e) {
    e.preventDefault();
    console.log('Akan diimplementasikan');
});
</script>
@endpush
