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
                                <a href="#!" id="like_btn" class="text-right mr-3 text-info"><i class="fas fa-thumbs-up"></i> Thích <span data-id={{ $comment->id }} class="liked">{{ $comment->likes }}</span></a>
                            @endif
                            </div>
                        <p class="comment-content"> {{ $comment->content }} </p>
                        <hr style="width: 90%;margin:1rem auto">
                    @endforeach
                    
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
                    <img class="post_dd_no_image" src="{{ asset('/images/admin/story/'.$story->avatar) }}" alt="CP">   
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
    {{-- <script>
        $(document).ready(function() {
            $('#like_btn').click(function(e) {
                var value = $('#like_btn span').html();
                if ($('#like_btn span').hasClass('liked')){
                    $('#like_btn span').removeClass('liked');
                    if (value>0) value--;
                } else {
                    $('#like_btn span').addClass('liked');
                    value++;
                }
                console.log(value);
                e.preventDefault();
            });
        });
        
    </script> --}}
@endpush