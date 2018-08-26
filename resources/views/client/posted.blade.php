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
            <div class="comment-form">
                <div class="comment-editor">
                    <textarea class="comment-input" id="form-178" name="comment" placeholder="Bạn nghĩ gì về tin này?">
        
                    </textarea>
                    <p class="editor-tool">
                        <a class="btnEmoticon">
                            <span class="ti-face-smile">
        
                            </span>
                        </a>
                    </p>
                </div>
                    <a class="button btnSubmit" href="#submit">Gửi bình luận</a>
                
            </div>
            <div class="comment_list clearfix">
                <div class="list_header">
                    <h4 class="list-title">Ý kiến bạn đọc <strong>(1)</strong></h4>
                </div>
                <div class="comment-meta">
                    <p class="author d-flex">Nhân Quả - <span class="time text-secondary"> 5 giờ trước</span></p>
                    <br>
                    <p class="comment-content">
                    Niềm tự hào Việt Nam </p>
                </div>
            </div>
        </div>
<div class="interest">
    <div class="post_dd">
        @if(count($related_news)>0)
            <h2>
                QUAN TÂM
            </h2>
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
                    <h4 class="text16">
                        {{ $story->title }}
                    </h4>
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