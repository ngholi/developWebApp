@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="panel panel-primary">

                    <div class="panel-body">
                        <div class="col-sm-5">
                            <img src="{{isset($employee->photo)?asset('img/'.$employee->photo):asset('img/icon-profile.png')}}" class="img-responsive" alt="Ảnh đại diện"><br>
                        </div>
                        <table class="responstable">
                            <tr>
                                <td><b>Name</b></td>
                                <td>{{$employee->name}}</td>
                            </tr>
                            <tr>
                                <td><b>Department</b></td>
                                <td>{{$employee->department_name}}</td>
                            </tr>
                            <tr>
                                <td><b>Job Title</b></td>
                                <td>{{$employee->jobtitle}}</td>
                            </tr>
                            <tr>
                                <td><b>Cellphone</b></td>
                                <td>{{$employee->cellphone}}</td>
                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td>{{$employee->email}}</td>
                            </tr>
                        </table>
                        <a href="{{url('/employee')}}"><button type="button" class="btn btn-clear btn-default">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection