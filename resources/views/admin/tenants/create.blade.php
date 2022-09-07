@extends('admin.layouts.app')

@section('title', 'New Tenant')

@section('content')
    {!! Form::open(['route' => 'admin.tenants.store', 'files' => true]) !!}
        @includeIf('admin.tenants.form.main')
    {!! Form::close() !!}
@endsection