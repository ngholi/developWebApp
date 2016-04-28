@if(Auth::check())
    <div class="panel panel-primary">
        <div class="panel-body">
            <a href="{{route('employee.add')}}" class="btn btn-success">Thêm nhân viên</a>
        </div>
    </div>
@endif
<form action="{{route('employee.search')}}" method="post" class="form-inline">
    {{ csrf_field() }}
    <input name="name" type="text" class="form-control">
    <select name="department_id" class="form-control">
        <option value="all">All</option>
        @foreach(\App\Model\Department\Department::all() as $department)
            <option value="{{$department->id}}">{{$department->name}}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-success">Search</button>
    <button type="button" class="btn btn-clear btn-default" id="btnClear">Clear</button>
</form>