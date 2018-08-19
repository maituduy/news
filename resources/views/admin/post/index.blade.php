@extends('layouts.admin.master')

@section('stories', 'active')
@section('title', 'Story Page')
@section('fa-class', 'fas fa-newspaper')
@section('url', 'stories')
@section('page', 'Stories')

@section('content')
    <a href="{{ route('stories.create') }}" class="btn btn-primary">Create</a>
    @forelse ($stories as $story)
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">{{ $story->title }}</h3>
                    <div class="tile-body">{{ $story->description }}</div>
                    <div class="tile-footer">
                        <a class="btn btn-primary" href="#">Link</a>
                        <a class="btn btn-success" href="#">View</a>
                    </div>

                </div>
            </div>
        </div>
    @empty
        <h1>Không có bài viết nào</h1>
    @endforelse
    
@endsection
