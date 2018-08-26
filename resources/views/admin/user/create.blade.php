@extends('layouts.admin.master')

@section('title', 'Thêm Thành Viên')
@section('users','active')
@section('fa-class', 'fa-user')
@section('url', 'users')
@section('page', 'Thêm Thành Viên')
@section('style')
    <style>
        .datepicker {
            top : 321px !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form method="post" action="{{route('users.store')}}" id="create_form">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Họ Và Tên</label>
                                <input class="form-control {{($errors->has('name')) ? 'is-invalid' : ''}}" type="text" placeholder="Enter full name" name="name" value="{{old('name')}}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Email</label>
                                <input class="form-control {{($errors->has('email')) ? 'is-invalid' : ''}}" type="email" placeholder="Enter email address" name="email" value="{{old('email')}}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Số Điện Thoại</label>
                                <input class="form-control" type="number" placeholder="Enter phone number" name="phone_number" value="{{old('phone_number')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Ngày Sinh</label>
                                <input class="form-control" id="demoDate" type="text" placeholder="Select Date" name="birthday" value="{{old('birthday')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Địa Chỉ</label>
                            <textarea class="form-control" rows="4" placeholder="Enter your address" name="address"> {{old('address')}}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Mật Khẩu</label>
                                <input class="form-control {{($errors->has('password')) ? 'is-invalid' : ''}}" type="password" name="password">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">{{$errors->first('password')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Xác Nhận Mật Khẩu</label>
                                <input class="form-control" type="password" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Giới Tính</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="sex" value="1">Nam
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="sex" value="0">Nữ
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" form="create_form" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Lưu</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('users.index')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Huỷ</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{asset('js/admin/plugins/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">
        $('#demoDate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });

    </script>
@endpush