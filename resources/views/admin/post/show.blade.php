@extends('layouts.admin.master')

@section('stories', 'active')
@section('title', $story->title)
@section('fa-class', 'fas fa-newspaper')
@section('url', 'stories')
@section('page', 'Xem Bài Viết')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <time class="text-dark">{{ format_time_store($story) }}</time>
                <h1 class="tile-title text-center">asc</h1>
                <div class="tile-body">
                    {!! $story->content !!}
                </div>
                <div class="tile-footer">
                    @forelse ($story->tags()->get() as $item)
                        <a class="btn btn-outline-secondary" href="">{{ $item->name }}</a>
                    @empty
                        
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="row user">
        <div class="col-md-12">
            <div class="tile">
                <h1 class="tile-title text-left">Bình Luận ({{ $story->comments()->count() }})</h1>
                <div class="tile-body infinite-scroll">
                    @forelse ($comments as $comment)
                    <div>
                        <p>{{ $comment->content }}</p>
                        <div class="d-flex flex-row">
                            <span class="text-secondary">
                                <a href="{{ route('users.edit', ['id'=> $comment->user->id]) }}">{{ $comment->user->name }}</a>
                                - {{ diffForHumans($comment) }}
                            </span>
                            <div class="text-right flex-grow-1 mr-4">
                                <p><i class="fas fa-thumbs-up"></i> {{ $comment->likes()->count() }} Thích</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                    @empty
                    @endforelse
                    {{ $comments->links() }}
                </div>
                   
            </div>
        </div>
    </div>
@endsection

@push('script')
<script src="//unpkg.com/jscroll/dist/jquery.jscroll.min.js"></script>
<script type="text/javascript">
    // ẩn thanh phân trang của laravel
    $('ul.pagination').hide();
    
    $(function() {
        var img = "{{ asset('/images/admin/loading.gif') }}";
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="rounded mx-auto d-block" style="width:30px" src="' + img +'" alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                // xóa thanh phân trang ra khỏi html mỗi khi load xong nội dung
                $('ul.pagination').remove();
            }
        });
    });
</script>   
@endpush