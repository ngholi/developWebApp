@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$title}}</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('department.edit')}}" method="post" accept-charset="utf-8">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{isset($department) ? $department->id : ""}}">
                            <div class="form-group">
                                <label>Tên phòng ban</label>
                                <input class="form-control" type="text" name="departmentName" maxlength="256" value="{{isset($department) ? $department->name : ""}}">
                            </div>
                            @if ($errors->has('departmentName'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('departmentName') }}</strong>
                                    </span>
                            @endif
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control" type="number" name="phone" maxlength="20" value="{{isset($department) ? $department->phone : ""}}">
                            </div>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                            <div class="form-group">
                                <label>Người quản lý</label>
                                <select class="form-control" name="manager">
                                    <option value = "none"></option>
                                    @foreach(\App\Model\Employee\Employee::all() as $employee)
                                        <option value = "{{$employee->id}}"
											@if(isset($department) && $employee->id == $department->manager)
                                                echo selected
                                            @endif
										>{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="submit">
                                <input type="submit" class="btn btn-success" value="{{$title}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection