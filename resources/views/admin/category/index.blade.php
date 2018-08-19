@extends('layouts.admin.master')

@section('categories','active')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Category Page')
@section('fa-class', 'fa-list-alt')
@section('url', 'Categories')
@section('page', 'Category')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="list-group cate_list">
                            @forelse($categories as $category)
                                <a class="list-group-item list-group-item-action" href="#">{{$category->name}}</a>
                            @empty
                            @endforelse

                        </div>
                        <button class="btn btn-primary mt-2 add_cate"><i class="fa fa-plus"></i>Thêm chuyên mục</button>
                        <button class="btn btn-primary mt-2 edit_cate"><i class="fa fa-fw fa-lg fa-check-circle"></i>Lưu</button>
                        <button class="btn btn-secondary mt-2 cancel_cate"><i class="fa fa-fw fa-lg
                        fa-times-circle"></i>Hủy</button>
                    </div>
                    <div class="col-md-8">

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('js/admin/plugins/bootstrap-notify.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.edit_cate , .cancel_cate').hide();
            $('.add_cate').click(function () {
                var input = '<input type="text" class="list-group-item list-group-item-action">';
                $('.cate_list').append(input);
                $('.add_cate').hide();
                $('.edit_cate ,.cancel_cate').show();
            });

            $('.cancel_cate').click(function () {
                $('.add_cate').show();
                $('.edit_cate ,.cancel_cate').hide();
                $('.cate_list input').remove();
            })
            
            $('.edit_cate').click(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                   url: '{{route('cateajax')}}',
                   method: 'post',
                   data: {
                       name: $('.cate_list input').val()
                   },
                   success: function(res) {
                       if(!res) {
                           var val = $('.cate_list input').val();
                           $('.cate_list input').remove();
                           $('.cate_list').append('<a class="list-group-item list-group-item-action" ' +
                               'href="#">'+val+'</a>');
                           $.notify({
                               message : 'Saved',
                               icon: 'fa fa-check'
                           },{
                               // settings
                               delay: 1000,
                               type: 'info',
                           });
                           $('.edit_cate , .cancel_cate').hide();
                           $('.add_cate').show();
                       }
                       else {
                           $.notify({
                               message : res,
                               icon: 'fa fa-times'
                           },{
                               // settings
                               type: 'danger',
                               delay: 1000
                           });
                       }
                   }
                });
            });
        });
    </script>
@endpush


