@extends('layouts.client.master')

@section('home_active', 'active')
@section('content')
    <div class="post">
        <div class="post_dd">
            @foreach ($categories as $category)
                @if(count($category->stories()->where('is_active', 1)->get())>0)
                <h5>
                    {{ $category->name }}
                </h5>
                <hr class="hr">
                <ul class='post_cn_ul'>
                    @forelse ($category->stories()->where('is_active', 1)->orderBy('created_at', 'desc')->take(5)->get() as $story)
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
                    @empty

                    @endforelse
                </ul>
                @endif
            @endforeach
        </div>
    </div>
@endsection