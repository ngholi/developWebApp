@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    {{--<div class="panel-heading">Không tìm thấy trang</div>--}}
                    <div class="panel-body">
                        <h3>Không tìm thấy trang</h3>
                        <a href="{{route('department')}}">Quay về trang chính</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection