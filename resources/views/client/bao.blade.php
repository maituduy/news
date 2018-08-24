@extends('layouts.client.master')

@section('content')
    <div class="post">
        <div class="post_dd">
            @foreach ($categories as $category)
                @if(count($category->stories()->get())>0)
                <h1>
                    {{ $category->name }}
                </h1>
                <hr class="hr">
                <ul class='post_cn_ul'>
                    @forelse ($category->stories()->orderBy('created_at', 'desc')->take(5)->get() as $story)
                    <li>
                        <a href="">
                            <img class="post_dd_no_image" src="{{ asset('/images/admin/story/'.$story->avatar) }}" alt="CP">   
                        </a>
                        <div class="post_des clear fix">
                        <a href="">
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
                    @empty

                    @endforelse
                </ul>
                @endif
            @endforeach
        </div>
    </div>
@endsection