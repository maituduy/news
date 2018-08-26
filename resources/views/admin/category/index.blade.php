@extends('layouts.admin.master')

@section('categories','active')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Chuyên Mục')
@section('fa-class', 'fa-list-alt')
@section('url', 'Categories')
@section('page', 'Chuyên Mục')

@section('content')
<div class="row user">
        
    <div class="col-md-3">
        <div class="tile p-0">
        <ul class="nav flex-column nav-tabs user-tabs">
            @foreach ($categories as $category)
                <li class="nav-item"><a class="nav-link {{ ($loop->first) ? ' active show' : '' }}" 
                    href="#user-timeline-{{ $category->id }}" data-toggle="tab">{{ $category->name }}</a></li>
            @endforeach
            
        </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            @foreach ($categories as $category)
                <div class="tab-pane {{ ($loop->first) ? ' active show' : '' }}" id="user-timeline-{{ $category->id }}">
                    @foreach ($category->stories()->orderBy('created_at', 'desc')->paginate(10) as $story)
                    <div class="timeline-post">
                        <div class="post-media"><a href="#"><img src="{{ asset($story->admin->avatar) }}"></a>
                            <div class="content">
                            <h5><a href="#">{{ $story->admin->name }}</a></h5>
                            <p class="text-muted"><small>{{ format_time_store($story) }}</small></p>
                            </div>
                        </div>
                        <div class="post-content">
                            <h5><a target="_blank" href="{{ route('stories.show', ['id' => $story->id]) }}">{{ $story->title }}</a></h5>
                            <p>{{ $story->description }}</p>
                        </div>
                        <ul class="post-utility">
                            {{-- <li class="likes"><i class="fas fa-thumbs-up"></i> {{ $story->likes }} Thích</li> --}}
                            <li class="comments"><a target="_blank" href="{{ route('stories.show', ['id' => $story->id]) }}"><i class="far fa-comment"></i> {{ $story->comments()->count() }} Bình Luận</a></li>
                        </ul>
                    </div>
                    @endforeach
                </div>
            @endforeach
            
        </div>
    </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('js/admin/plugins/bootstrap-notify.min.js')}}"></script>
    
@endpush


