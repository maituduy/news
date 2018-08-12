@extends('layouts.admin.master')

@section('title', 'User Page')
@section('users','active')
@section('fa-class', 'fa-user')
@section('url', 'users')
@section('page', 'User')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div>
                    <h3 class="tile-title d-inline-block">Bảng thành viên</h3>
                    <div class="float-right">
                        <a class="btn btn-primary text-white" href="{{route('users.create')}}"><i
                                    class="fa fa-plus"></i>Add</a>
                        <button type="submit" class="btn btn-danger text-white delete_btn" form="delete_form"><i
                                    class="fa fa-trash-o"></i>Delete
                        </button>
                    </div>
                </div>
                <form action="{{route('users.destroymany')}}" method="post" id="delete_form">
                    {{csrf_field()}}
                    <div class="table-responsive">
                        <table id="user_table" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th class="animated-checkbox ">
                                    <label>
                                        <input type="checkbox" class="check_all"><span class="label-text"></span>
                                    </label>
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            @forelse($users as $user)
                                <tr>
                                    <td class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" class="user_checkbox" name="checkbox[]"
                                                   value="{{$user->id}}"><span class="label-text"></span>
                                        </label>
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{($user->is_active)? 'On': 'Banned'}}</td>
                                    <td>{{Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
                                    <td class="text-right">
                                        <a href="{{route('users.change', ['id' => $user->id])}}"
                                           class="btn btn-warning"><i class="fa {{($user->is_active)? 'fa-lock': 'fa-unlock'}}"></i></a>
                                        <a href="{{route('users.edit', ['id' => $user->id])}}" class="btn
                                        btn-primary">Edit</a>
                                    </td>
                                </tr>

                            @empty
                                <p>No users</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection

@section('script')
    <script src="{{asset('js/admin/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/admin/plugins/dataTables.bootstrap.min.js')}}"></script>
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
            $('#user_table .animated-checkbox').removeClass('sorting_asc');
            $('.check_all').click(function () {
                var check_list = $('#user_table .user_checkbox');
                if (!$('.check_all').is(':checked')) {
                    check_list.prop('checked', false)
                }
                else check_list.prop('checked', true);
            });
        });
    </script>

@endsection