@extends('admin.layouts.app')

@section('title', "Edit \"{$tenant->name}\" Tenant")

@section('content')
    {!! Form::model($tenant, ['route' => ['admin.tenants.update', 'tenant' => $tenant, 'currentTab' => $currentTab], 'method' => 'PUT', 'files' => true]) !!}
        @includeIf("admin.tenants.form.{$currentTab}")
    {!! Form::close() !!}
@endsection