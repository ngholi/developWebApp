@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="panel panel-primary">

                    <div class="panel-body">
                        <div class="col-sm-5">
                        </div>
                        <table class="responstable">
                            <tr>
                                <td><b>Tên phòng ban</b></td>
                                <td>{{$department->name}}</td>
                            </tr>
                            <tr>
                                <td><b>Số điện thoại</b></td>
                                <td>{{$department->phone}}</td>
                            </tr>
                            <tr>
                                <td><b>Người quản lý</b></td>
                                <td>{{$department->manager_name}}</td>
                            </tr>
                        </table>
                        <a href="{{route('department')}}"><button type="button" class="btn btn-clear btn-default">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection