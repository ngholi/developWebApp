@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::check())
        <div class="panel panel-primary">
            <div class="panel-body">
                <a href="{{route('department.add')}}" class="btn btn-success">Thêm phòng ban</a>
            </div>
        </div>
        @endif
        <h3>Departments</h3>
        <table class="responstable">
            <thead>
                <tr>
                    <th></th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Quản lý</th>
                    @if(Auth::check())
                        <th>Tùy chọn</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            <?php $count=1?>
                @foreach($departments as $department)
                    <tr>
                        <td>{{$count++}}</td>
                        <td><a href="{{url('department/profile/'.$department->id)}}">{{$department->name}}</a></td>
                        <td>{{$department->phone}}</td>
                        <td>{{is_object($department->managedBy)? $department->managedBy->name : ""}}</td>
                        @if(Auth::check())
                            <td>

                                <form action="{{route('department.delete')}}" method="POST">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                    <a href="{{url('department/'.$department->id.'/list')}}" class="btn btn-info" id="emplist-dep-{{ $department->id }}">
                                        Nhân viên
                                    </a>
                                    <a href="{{ url('department/edit/'.$department->id) }}" class="btn btn-success" id="edit-dep-{{ $department->id }}">
                                        Sửa
                                    </a>
                                    <input type="hidden" name="department_id" value="{{$department->id}}">
                                    <button type="submit" class="btn btn-danger" id="delete-dep-{{ $department->id }}">
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
@endsection