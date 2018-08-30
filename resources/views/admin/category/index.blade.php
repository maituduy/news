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
                <li class="nav-item">
                    <input type="text" name="" class="form-control input_add d-none" placeholder="Nhập tên chuyên mục">
                </li>
            </ul>
        </div>
        <button class="w-100 btn btn-primary btn_add">Thêm Chuyên Mục</button>
        <div class="btn-group w-100 d-none group_add">
            <button class="w-100 btn btn-primary btn_save">Lưu</button>
            <button class="w-100 btn btn-primary btn_cancel">Huỷ</button>
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
    <script>
        $(document).ready(function() {
            $('.btn_add').click(function() {
                $('.group_add').removeClass('d-none');
                $('.input_add').removeClass('d-none');
                $(this).addClass('d-none');
            });
            $('.btn_cancel').click(function() {
                $('.group_add').addClass('d-none');
                $('.input_add').addClass('d-none');
                $('.btn_add').removeClass('d-none');
            });
            $('.btn_save').click(function() {
                var category = $('.input_add').val();
                if (!category || category.trim() == '')
                    showNotify('Tên chuyên mục không được trống', 'danger');
                else {
                    var check = true;
                    $('.nav-item .nav-link').each(function() {
                        if ($(this).html() == category) {
                            showNotify('Tên chuyên mục đã tồn tại', 'danger');
                            check = false;
                        }
                    });
                    if(check) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url : "{{ url('/admin/ajax_category') }}",
                            method : 'post',
                            data : {category : category},
                            success : function(res) {
                                var html = '<li class="nav-item"><a class="nav-link" href="#user-timeline-'+res+'" data-toggle="tab">'+category+'</a></li>';
                                $('.input_add').before(html);
                                $('.input_add').addClass('d-none');
                                $('.input_add').val('');
                                showNotify('Thêm thành công', 'primary');
                            }
                        });
                    }
                        
                }
            });
            function showNotify(message, type) {
                $.notify({
                        // options
                        message: message 
                    },{
                        // settings
                        type: type
                    });
            }
        });
    </script>
@endpush


