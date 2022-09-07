@extends('admin.layouts.app')

@section('title', 'New User')

@section('content')
    {!! Form::open(['route' => 'admin.users.store', 'files' => true]) !!}
        @includeIf('admin.users.form')
    {!! Form::close() !!}
@endsection