@extends('layouts.client.master')

@section('content')
    <h1>
        {{ $cate_name }}
    </h1>
    <hr class="hr">
    <div class="post">
        <div class="post_dd">
            <ul class='post_cn_ul'>
                @forelse ($stories as $story)
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
        </div>
        {{ $stories->links() }}
    </div>
@endsection