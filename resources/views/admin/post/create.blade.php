@extends('layouts.admin.master')

@section('stories', 'active')
@section('title', 'Thêm Bài Viết')
@section('fa-class', 'fas fa-newspaper')
@section('url', 'stories')
@section('page', 'Thêm Bài Viết')
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="tile">
    <form method="post" action="{{ route('stories.store') }}" enctype="multipart/form-data" >
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu Đề<span> *</span></label>
                    <input type="text" name="title" class="form-control {{ ($errors->has('title')) ? 'is-invalid' : '' }}"
                    id="exampleInputEmail1" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputSelect">Chuyên Mục</label>
                    <select name="category" class="form-control" id="exampleInputSelect">
                        @foreach (App\Category::all() as $category)
                            <option value="{{ $category->id }} ">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFile">Ảnh</label>
                    <input type="file" name="image" class="form-control-file {{ ($errors->has('image')) ? 'is-invalid' : '' }}" id="exampleFile">
                    @if ($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                    @endif
                </div>
            </div>      
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputDes">Mô Tả<span> *</span></label>
                    <textarea name="description" rows="5"  class="form-control {{ ($errors->has('description')) ? 'is-invalid' : '' }}" id="exampleInputDes">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Nội Dung<span> *</span></label>
                    <textarea name="content" class="form-control {{ ($errors->has('content')) ? 'is-invalid' : '' }}" id="exampleFormControlTextarea1">{{ old('content') }}</textarea>
                </div>
                @if ($errors->has('content'))
                <div class="invalid-feedback">
                    {{ $errors->first('content') }}
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="tags_select">Thẻ</label>
                    <select name="tags[]" class="form-control tags" multiple="multiple" id="tags_select"></select>
                </div> 
                
            </div>
        </div>
        <div class="tile-footer">
            <button class="btn btn-primary"><i class="fas fa-angle-double-down mr-1"></i>Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-ban mr-1"></i>Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/ckfinder/ckfinder.js') }}"></script>
    <script>
        CKEDITOR.replace( 'content' , {
            language : 'vi',
            filebrowserBrowseUrl: '{{ asset('/js/ckfinder/ckfinder.html') }}',
	        filebrowserUploadUrl: '{{ asset('/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}'
        });
        $(".tags").select2({
           tags: true
        });
    </script>
@endpush
