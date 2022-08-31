@extends('admin.layouts.app')

@section('title', 'Tenants')

@php
    $breadcrumbs = [];

    $actions = [
        [
            'title' => 'New Tenant',
            'link' => route('admin.tenants.create'),
            'primary' => true,
            'icon' => '<path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />'
        ]
    ];

    $bulkAction = 'tenant';
@endphp

@section('content')
    <script>
        var allData = {{ Js::from($tenants->pluck('id')) }}
    </script>

    @if ( $tenants->isNotEmpty() )
        <div class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                        <input 
                                            type="checkbox" 
                                            x-on:click="selected.length === window.allData.length ? selected = [] : selected = window.allData" 
                                            class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6" 
                                        >
                                    </th>
                                    <th scope="col" class="py-3.5 pl-3 pr-3 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Owner</th>
                                    <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-500 uppercase tracking-wider">Ends at</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-500 uppercase tracking-wider">Users</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Creation</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($tenants as $tenant)
                                    <tr :class="selected.includes({{ $tenant->id }}) ? 'bg-indigo-50 hover:bg-indigo-100' : 'even:bg-gray-50 hover:bg-gray-100'">
                                        <td class="relative w-12 px-6 sm:w-16 sm:px-8">
                                            <div class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600" x-show="selected.includes({{ $tenant->id }})"></div>
                                            <input 
                                                type="checkbox" 
                                                value="{{ $tenant->id }}" 
                                                x-model.number="selected" 
                                                class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6" 
                                                checked="selected.includes({{ $tenant->id }})"
                                            >
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-full" src="{{ !empty($tenant->logo_url) ? $tenant->logo_url : 'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-medium text-gray-700">{{ $tenant->name }}</div>
                                                    <div class="text-gray-500">{{ $tenant->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="font-medium text-gray-700">{{ $tenant->owner->name }}</div>
                                            <div class="text-gray-500">{{ $tenant->owner->email }}</div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm {{ $tenant->isExceeded() ? 'text-red-500 font-medium' : 'text-gray-500' }}">
                                            <div class="flex justify-end items-center">
                                                <svg class="mr-1.5 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                                                </svg>
                                                <p>
                                                    {{ !empty($tenant->ends_at) ? 'Closing on ' : 'Full-time' }}
                                                    @if ( !empty($tenant->ends_at) )
                                                        <time datetime="{{ $tenant->ends_at->format('Y-m-d') }}">{{ $tenant->ends_at->format('F d, Y') }}</time>
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $tenant->users_count }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-left text-gray-500">{{ $tenant->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="{{ route('admin.tenants.edit', $tenant) }}" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, {{ $tenant->name }}</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $tenants->links() }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center bg-white px-4 py-5 sm:px-6 shadow rounded-lg">
            <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No tenants</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new tenant.</p>
            <div class="mt-6">
                <a href="{{ route('admin.tenants.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    New Tenant
                </a>
            </div>
        </div>
    @endif
@endsection