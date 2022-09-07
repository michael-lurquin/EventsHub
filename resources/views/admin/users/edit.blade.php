@extends('admin.layouts.app')

@section('title', "Edit \"{$user->fullname}\" user")

@section('content')
    {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'PUT', 'files' => true]) !!}
        @includeIf('admin.users.form')
    {!! Form::close() !!}
@endsection