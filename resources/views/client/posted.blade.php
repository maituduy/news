@extends('layouts.client.master')

@push('style')
    <style>
        table[align="center"] {
            margin: 0 auto;
        }
        table[align="center"] tbody {
            text-align: center;
        }
    </style>
       
@endpush
@section('content')
<div>
    <div class="story_header clearfix">
        <time>{{ format_time_store($story) }}</time>
        <input type="hidden" value="{{ $story->category->id }}">
        <h1 class="text_left left full_width height30">
            {{ $story->title }}
        </h1>
        <div class="story_desc">
            <h6>{{ $story->description }}</h6>
        </div>
    </div>
    <hr>
    <div>
        {!! $story->content !!}
    </div>
</div>
<hr>
<div class="tags">   
        <ul>
            <li >Thẻ:</li>
            @foreach ($story->tags()->get() as $tag)
                <li><a href="{{ route('tag', ['slug' => slug($tag->name), 'id' => $tag->id]) }}">{{ $tag->name }}</a></li>
            @endforeach
            
        </ul>
        </div>
        <div class="cmt clearfix">
            @if (auth()->check())
                <form action="{{ route('comment', ['story' => $story]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="comment-form">
                        <div class="comment-editor">
                            <textarea class="comment-input" id="form-178" name="comment" placeholder="Bạn nghĩ gì về tin này?"></textarea>
                        </div>
                        <button class="button btnSubmit">Gửi bình luận</button>
                    </div>
                </form>
            @endif
            <br>
            <div class="comment_list clearfix">
                <div class="list_header">
                    <h4 class="list-title">Ý kiến bạn đọc <strong>({{ $story->comments()->count() }})</strong></h4>
                </div>
                <div class="comment-meta">
                    @foreach ($comments as $comment)
                         <div class="d-flex author">
                            <p>{{ $comment->user->name }} - <span class="time text-secondary"> {{ diffForHumans($comment) }}</span></p>
                            <div class="flex-grow-1"></div>
                            @if (auth()->check())
                                <a href="#!" class="text-right mr-3 like_btn {{ checkLikeAuthUser($comment) ? 'text-info' : 'text-secondary' }}">
                                    <i class="fas fa-thumbs-up"></i> 
                                    <b>{{ checkLikeAuthUser($comment) ? 'Đã Thích' : 'Thích' }}</b>     
                                    <span data-id={{ $comment->id }} class="text-secondary {{ (checkLikeAuthUser($comment)) ? 'liked' : ''}}">{{ $comment->likes()->count() }}</span>
                                </a>
                            @endif
                            </div>
                        <p class="comment-content"> {{ $comment->content }} </p>
                        <hr style="width: 90%;margin:1rem auto">
                    @endforeach
                    {{ $comments->links() }}
                </div>
                
            </div>
        </div>
<div class="interest">
    <div class="post_dd">
        @if(count($related_news)>0)
            <h6>
                QUAN TÂM
            </h6>
        @endempty
        <hr class="hr">
        <ul class='post_cn_ul'>
            @foreach ($related_news as $story)
            <li>
                <a href="{{ route('story', ['cate' => slug($story->category->name), 'slug' => $story->slug, 'id' => $story->id]) }}">
                    <img class="post_dd_no_image" src="{{ $story->avatar }}" alt="CP">   
                </a>
                <div class="post_des clear fix">
                <a href="{{ route('story', ['cate' => slug($story->category->name), 'slug' => $story->slug, 'id' => $story->id]) }}">
                    <h6 class="text16">
                        {{ $story->title }}
                    </h6>
                </a>
                <p class="line_height2">
                    {{ $story->description }}    
                </p>
                </div>
                <hr class='hr_center'>
            </li>                        
            @endforeach
        </ul>
    </div>
</div>
@endsection

@push('script')
    <script src="{{asset('js/admin/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            var id = $('.story_header').children('input').val();
            $('.menu_center li a').each(function() {
            if ($(this).data('category') == id)
                $(this).addClass('active');
            });


            $('.like_btn').click(function(e) {
                var el = $(this).children('span');
                var content = $(this).children('b');
                var value = el.html();  
                if (el.hasClass('liked')){
                    el.removeClass('liked');
                    $(this).removeClass('text-info');
                    $(this).addClass('text-secondary');
                    content.html('Thích');
                    el.html(--value);
                } else {
                    el.addClass('liked');
                    $(this).removeClass('text-secondary');
                    $(this).addClass('text-info');
                    content.html('Đã Thích');
                    el.html(++value);
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }); 
                $.ajax({
                    url : "{{ url('/ajax_like') }}",
                    method : 'post',
                    data : {id : el.data('id')},
                    success : function(res) {
                        console.log(res);
                    }
                });
                
                e.preventDefault();
            });
        });
        
    </script>
@endpush