@extends('layouts.admin.master')

@section('stories', 'active')
@section('title', 'Story Page')
@section('fa-class', 'fas fa-newspaper')
@section('url', 'stories')
@section('page', 'Stories')

@section('content')
    @if (empty($stories))
        <a href="{{ route('stories.create') }}" class="btn btn-primary mb-5">Create</a>
    @endif
    @forelse ($stories as $story)
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h3 class="title">{{ $story->title }}</h3>
                        <div class="btn-group">
                            <a class="btn btn-primary" href="{{ route('stories.create') }}"><i class="fa fa-lg fa-plus"></i></a>
                            <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-edit"></i></a>
                            <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="tile-body">
                        <b>{{ $story->category->name }}</b>
                        <br>
                        {{ $story->description }}
                    </div>
                    <div class="tile-footer">
                        
                    </div>
                </div>
            </div>
        </div>
    @empty
        <h1>Không có bài viết nào</h1>
    @endforelse
    
@endsection
