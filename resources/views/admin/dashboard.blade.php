@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-3xl font-bold leading-tight tracking-tight text-gray-700">{{ auth()->user()->currentTenant->name }} Dashboard</h1>
    <p class="mt-1 text-base font-medium text-gray-500">Welcome back, {{ auth()->user()->name }}</p>

    <div class="mt-4 bg-white rounded-lg shadow-sm border border-gray-300 p-4">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, consectetur dolorem, odit cumque sit error reprehenderit dolores inventore illo recusandae eos consequatur! Neque fugit, quae reprehenderit ducimus illo officia eius!</p>
    </div>
@endsection