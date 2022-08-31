@extends('admin.layouts.app')

@section('title', 'New Tenant')

@php
    $breadcrumbs = [
        [
            'title' => 'Tenants',
            'link' => route('admin.tenants.index')
        ]
    ];
@endphp

@section('content')

@endsection