@extends('layouts.admin.master')

@section('stories', 'active')
@section('title', $story->title)
@section('fa-class', 'fas fa-newspaper')
@section('url', 'stories')
@section('page', 'Edit Story')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <code class="text-dark">{{ format_time_store($story) }}</code>
                <h1 class="tile-title text-center">asc</h1>
                <div class="tile-body">
                    {!! $story->content !!}
                </div>
                <div class="tile-footer">
                    @forelse ($story->tags()->get() as $item)
                        <a class="btn btn-outline-secondary" href="">{{ $item->name }}</a>
                    @empty
                        
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection