@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">文章管理</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <a href="{{ url('admin/papers/create') }}" class="btn btn-lg btn-primary">新增</a>

                    @foreach ($papers as $paper)
                        <hr>
                        <div class="paper">
                            <h4>{{ $paper->title }}</h4>
                            <div class="content">
                                <p>
                                    {{ $paper->body }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ url('admin/papers/'.$paper->id.'/edit') }}" class="btn btn-success">编辑</a>
                        <form action="{{ url('admin/papers/'.$paper->id) }}" method="POST" style="display: inline;">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">删除</button>
                        </form>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection