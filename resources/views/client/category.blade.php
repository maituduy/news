@extends('layouts.client.master')
@section('content')
    <h5>
        {{ $cate_name }}
    </h5>
    <hr class="hr">
    <div class="post">
        <div class="post_dd">
            <ul class='post_cn_ul'>
                @forelse ($stories as $story)
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
                @empty

                @endforelse
                
                
            </ul>
        </div>
        {{ $stories->links() }}
    </div>
@endsection