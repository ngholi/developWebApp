@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Đổi mật khẩu {{!Auth::user()->was_changed_pass? ' cho lần đăng nhập đầu tiên':''}}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user.changepass') }}">
                            {!! csrf_field() !!}


                            <div class="form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Mật khẩu cũ</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="oldPassword" value="{{old('oldPassword')}}">

                                    @if ($errors->has('oldPassword'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Mật khẩu mới</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" value="{{old('password')}}">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('rePassword') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Nhập lại mật khẩu</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="rePassword" value="{{old('rePassword')}}">

                                    @if ($errors->has('rePassword'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('rePassword') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Đổi mật khẩu
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection