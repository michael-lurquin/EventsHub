@extends('admin.layouts.app')

@section('title', 'Tenants')

@php $bulkAction = 'tenant' @endphp

@section('content')
    <script>
        var allData = {{ Js::from($tenants[$currentTab]->pluck('id')) }}
    </script>

    <aside>
        @includeIf('admin.tenants.tabs')
        <div class="mx-auto max-w-7xl py-6">
            @if ( $tenants[$currentTab]->isNotEmpty() )
                <div class="flex flex-col">
                    <div class="-mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                @includeWhen(session('success'), 'admin.layouts.flash')
                                <table class="min-w-full divide-y divide-gray-300 {{ session('success') ? 'border-t border-gray-300' : '' }}">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                                <input 
                                                    type="checkbox" 
                                                    x-on:click="selected.length === window.allData.length ? selected = [] : selected = window.allData" 
                                                    class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 sm:left-6" 
                                                >
                                            </th>
                                            <th scope="col" class="py-3.5 pl-3 pr-3 text-left text-xs text-gray-500 uppercase tracking-wider">Name</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-xs text-gray-500 uppercase tracking-wider">Owner</th>
                                            <th scope="col" class="px-3 py-3.5 text-right text-xs text-gray-500 uppercase tracking-wider">Ends at</th>
                                            <th scope="col" class="px-3 py-3.5 text-center text-xs text-gray-500 uppercase tracking-wider">Users</th>
                                            <th scope="col" class="px-3 py-3.5 text-right text-xs text-gray-500 uppercase tracking-wider">Creation</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach($tenants[$currentTab] as $tenant)
                                            <tr :class="selected.length > 0 && selected.includes({{ $tenant->id }}) ? 'bg-primary-50 hover:bg-primary-100' : 'even:bg-gray-50 hover:bg-gray-100'">
                                                <td class="relative w-12 px-6 sm:w-16 sm:px-8">
                                                    <div class="absolute inset-y-0 left-0 w-0.5 bg-primary-600" x-show="selected.length > 0 && selected.includes({{ $tenant->id }})"></div>
                                                    <input 
                                                        type="checkbox" 
                                                        value="{{ $tenant->id }}" 
                                                        x-model.number="selected" 
                                                        class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 sm:left-6" 
                                                        checked="selected.includes({{ $tenant->id }})"
                                                    >
                                                </td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm">
                                                    <div class="flex items-center">
                                                        @if ( !empty($tenant->logo_url) )
                                                            <div class="h-10 w-auto flex-shrink-0">
                                                                <img class="h-10 w-auto rounded-md" src="{{ asset($tenant->logo_url) }}" alt="">
                                                            </div>
                                                        @else
                                                            <span class="h-10 w-10 flex-shrink-0 {{ $loop->even ? 'bg-white' : 'bg-gray-100' }} border border-gray-200 rounded-md flex justify-center items-center text-gray-500 p-1.5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                                                </svg>
                                                            </span>
                                                        @endif
                                                        <div class="ml-4">
                                                            <div class="font-medium text-gray-700">{{ $tenant->name }}</div>
                                                            <div class="text-gray-500">{{ $tenant->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <div class="font-medium text-gray-700">{{ $tenant->owner->fullname }}</div>
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
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-right text-gray-500">{{ $tenant->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 space-x-2">
                                                    @if ( $tenant->trashed() )
                                                        <a href="{{ route('admin.tenants.restore', $tenant) }}" class="text-yellow-600 hover:text-yellow-900">Restore<span class="sr-only">, {{ $tenant->name }}</span></a>
                                                        <a href="{{ route('admin.tenants.destroy.force', $tenant) }}" class="text-red-600 hover:text-red-900">Delete<span class="sr-only">, {{ $tenant->name }}</span></a>
                                                    @else
                                                        <a href="{{ route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => 'main']) }}" class="text-primary-600 hover:text-primary-900">Edit<span class="sr-only">, {{ $tenant->name }}</span></a>
                                                        <a href="{{ route('admin.tenants.destroy.confirm', $tenant) }}" class="text-red-600 hover:text-red-900">Delete<span class="sr-only">, {{ $tenant->name }}</span></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $tenants[$currentTab]->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if ( $currentTab === 'all' )
                    <div class="text-center bg-white px-4 py-5 sm:px-6 shadow rounded-lg mt-2">
                        <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-700">No tenants</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new tenant.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.tenants.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>
                                New Tenant
                            </a>
                        </div>
                    </div>
                @elseif ( $currentTab === 'expired' )
                    <div class="text-center bg-white px-4 py-5 sm:px-6 shadow rounded-lg mt-2">
                        <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-500">No tenants expired</h3>
                    </div>
                @elseif ( $currentTab === 'trash' )
                    <div class="text-center bg-white px-4 py-5 sm:px-6 shadow rounded-lg mt-2">
                        <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-500">No tenants trashed</h3>
                    </div>
                @endif
            @endif
        </div>
    </aside>
@endsection