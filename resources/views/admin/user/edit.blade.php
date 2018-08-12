@extends('layouts.admin.master')

@section('title', 'Edit User')
@section('users','active')
@section('fa-class', 'fa-user')
@section('url', 'users')
@section('page', 'Sửa thành viên')
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
                    <form method="post" action="{{route('users.update', ['id' => $user->id])}}" id="update_form">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Name</label>
                                <input class="form-control {{($errors->has('name')) ? 'is-invalid' : ''}}"
                                       type="text" placeholder="Enter full name" name="name" value="{{($errors->has('name')) ? old('name') : $user->name}}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Email</label>
                                <input class="form-control {{($errors->has('email')) ? 'is-invalid' : ''}}"
                                       type="email" placeholder="Enter email address" name="email" value="{{
                                       ($errors->has('email')) ? old('email') : $user->email}}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Phone Number</label>
                                <input class="form-control" type="number" placeholder="Enter phone number"
                                       name="phone_number" value="{{ ($errors->any()) ? old('phone_number') :
                                       $user->phone_number}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Birthday</label>
                                <input class="form-control" id="demoDate" type="text" placeholder="Select Date"
                                       name="birthday" value="{{($errors->any()) ? old('birthday') :
                                       $user->birthday}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Address</label>
                            <textarea class="form-control" rows="4" placeholder="Enter your address"
                                      name="address">{{($errors->any()) ? old('address') :$user->address}}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Gender</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="sex" value="1" {{($user->sex)
                                    ? 'checked' : ''
                                    }}>Male
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="sex" value="0"{{(!$user->sex)
                                         ? 'checked' : ''}}>Female
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" form="update_form" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('users.index')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{asset('js/admin/plugins/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">
        $('#demoDate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });

    </script>
@endsection