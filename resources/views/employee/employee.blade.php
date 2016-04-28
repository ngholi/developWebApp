@extends('layouts.app')

@section('content')
    <div class="container">
    @if(Auth::check())
        <div class="panel panel-primary">
            <div class="panel-body">
                <a href="{{route('employee.add')}}" class="btn btn-success">Thêm nhân viên</a>
            </div>
        </div>
    @endif
    <form action="{{route('employee.search')}}" method="post" class="form-inline">
        {{ csrf_field() }}
        <input name="name" type="text" class="form-control" value="{{isset($name)? $name:''}}">
        <select name="department_id" class="form-control">
            <option value="all">All</option>
            @foreach(\App\Model\Department\Department::all() as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-success">Search</button>
        <button type="button" class="btn btn-clear btn-default" id="btnClear">Clear</button>
    </form>
    <h3>Employees</h3>
    <table class="responstable">
        <thead>
            <tr>
                <th></th>
                <th>Tên</th>
                <th>Phòng ban</th>
                <th>Chức vụ</th>
                <th>Email</th>
                @if(Auth::check())
                <th>Tùy chọn</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <?php $count=1?>
            @foreach($empList as $emp)
                <tr>
                    <td>{{$count++}}</td>
                    <td><a href="{{url('employee/profile/'.$emp->id)}}">{{$emp->name}}</a></td>
                    <td>{{is_object($emp->department)? $emp->department->name : ""}}</td>
                    <td>{{$emp->jobtitle}}</td>
                    <td>{{$emp->email}}</td>
                    @if(Auth::check())
                    <td>

                        <form action="{{ route('employee.delete') }}" method="POST">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <a href="{{ url('employee/edit/'.$emp->id) }}" class="btn btn-success" id="edit-emp-{{ $emp->id }}">
                                Sửa
                            </a>
                            <input type="hidden" name="employee_id" value="{{$emp->id}}">
                            <button type="submit" id="delete-emp-{{ $emp->id }}" class="btn btn-danger">
                                Xóa
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <script src="{{asset('js/myScript.js')}}"></script>
@endsection