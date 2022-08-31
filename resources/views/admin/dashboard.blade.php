@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach($cards as $card)
            @includeIf('admin.components.card-stat', $card)
        @endforeach
    </dl>
@endsection