@extends('layouts.admin.master')

@section('stories', 'active')
@section('title', 'Story Page')
@section('fa-class', 'fas fa-newspaper')
@section('url', 'stories')
@section('page', 'Stories')

@section('content')
    @forelse ($stories as $story)
    <form action="{{ route('stories.destroy', ['id' => $story->id]) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h3 class="title"><a href="{{ route('stories.show', ['id' => $story->id]) }}">{{ $story->title }}</a></h3>
                        <div class="btn-group">
                            <a class="btn btn-primary" href="{{ route('stories.create') }}"><i class="fa fa-lg fa-plus"></i></a>
                            <a class="btn btn-primary" href="{{ route('stories.edit', ['id' => $story->id]) }}"><i class="fa fa-lg fa-edit"></i></a>
                            <button class="btn btn-primary"><i class="fa fa-lg fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="tile-body">
                        <b>{{ $story->category->name }}</b>
                        <br>
                        {{ $story->description }}
                    </div>
                    <div class="tile-footer">
                        @forelse ($story->tags()->get() as $tag)
                            <button class="btn btn-secondary disabled not-allowed" type="button">{{ $tag->name }}</button>
                        @empty
                            
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </form>
    @empty
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <a href="{{ route('stories.create') }}" class="btn btn-primary mb-5">Create</a>
            </div>
        </div>
    </div>
    @endforelse
    
@endsection
