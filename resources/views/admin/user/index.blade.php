@extends('layouts.admin.master')

@section('title', 'Thành Viên')
@section('users','active')
@section('fa-class', 'fa-user')
@section('url', 'users')
@section('page', 'Thành Viên')

@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="row">   
        <div class="col-md-12">
            <div class="tile">
                <div>
                    <h3 class="tile-title d-inline-block">Bảng thành viên</h3>
                    <div class="float-right">
                        <a class="btn btn-primary text-white" href="{{route('users.create')}}"><i
                                    class="fa fa-plus"></i>Thêm</a>
                        <button class="btn btn-danger text-white delete_btn" form="delete_form"><i
                                    class="fas fa-trash-alt mr-2"></i>Xoá
                        </button>
                    </div>
                </div>
                <form action="{{route('users.destroymany')}}" method="post" id="delete_form">
                    {{csrf_field()}}
                    <div class="table-responsive">
                        <table id="user_table" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th class="my-checkbox">
                                    <div class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" class="check_all"><span class="label-text"></span>
                                        </label>
                                    </div>
                                </th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Trạng Thái</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>


                            @forelse($users as $user)
                                <tr>
                                    <td class="my-checkbox">
                                        <div class="animated-checkbox">
                                            <label>
                                                <input type="checkbox" class="user_checkbox" name="checkbox[]" value="{{$user->id}}">
                                                <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{($user->is_active)? 'Bật': 'Khoá'}}</td>
                                    <td>{{Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
                                    <td class="text-right">
                                        <a href="{{route('users.change', ['id' => $user->id])}}"
                                           class="btn btn-warning">{{ ($user->is_active) ? 'Khoá': 'Mở Khoá' }}</a>
                                        <a href="{{route('users.edit', ['id' => $user->id])}}" class="btn
                                        btn-primary">Sửa</a>
                                    </td>
                                </tr>

                            @empty
                                <p>Không có người dùng nào</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection

@push('script')
    <script src="{{asset('js/admin/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('js/admin/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/admin/plugins/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#user_table').DataTable({
                columnDefs: [{
                    class: "sorting_disable",
                    orderable: false,
                    searchable: false,
                    targets: 0
                }]
            });
            $('#user_table .my-checkbox').removeClass('sorting_asc');
            $('.check_all').click(function () {
                var check_list = $('#user_table .user_checkbox');
                if (!$('.check_all').is(':checked')) {
                    check_list.prop('checked', false)
                }
                else check_list.prop('checked', true);
            });

            $('.delete_btn').click(function() {
                swal({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể phục hồi những người dùng này",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Xoá",
                    cancelButtonText: "Huỷ",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        document.getElementById('delete_form').submit();
                    } 
                });
            });
        });
    </script>

@endpush