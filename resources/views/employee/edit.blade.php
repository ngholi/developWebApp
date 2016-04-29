@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"></h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('employee.edit')}}" class="container-fluid" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{isset($employee)? $employee->id : ""}}">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img src="{{isset($employee->photo)?asset('img/'.$employee->photo):asset('img/icon-profile.png')}}" class="img-responsive" alt="Ảnh đại diện"><br>
                                    <input type="file" name="avatar">
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label>Tên nhân viên</label>
                                        <input class="form-control" name="name" type="text" value="{{isset($employee)? $employee->name : ""}}">
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                    <div class="form-group">
                                        <label>Phòng ban</label>
                                        <select name="department_id" class="form-control">
                                            @foreach(\App\Model\Department\Department::all() as $department)
                                                <option value="{{$department->id}}"
													@if(isset($employee) && $employee->department_id == $department->id)
                                                         echo selected
                                                     @endif>{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Chức vụ</label>
                                        <input class="form-control" name="jobTitle" type="text" value="{{isset($employee)? $employee->jobtitle : ""}}">
                                    </div>
                                    @if ($errors->has('jobTitle'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('jobTitle') }}</strong>
                                    </span>
                                    @endif
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input class="form-control" name="cellPhone" type="number" maxlength="20" value="{{isset($employee)? $employee->cellphone : ""}}">
                                    </div>
                                    @if ($errors->has('cellPhone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cellPhone') }}</strong>
                                    </span>
                                    @endif
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" type="email" value="{{isset($employee)? $employee->email : ""}}">
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <div class="submit">
                                        <input type="submit" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection