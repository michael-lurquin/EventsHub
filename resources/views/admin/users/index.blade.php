@extends('admin.layouts.app')

@section('title', 'Users')

@php $bulkAction = 'tenant' @endphp

@section('content')
    <script>
        var allData = {{ Js::from($users[$currentTab]->pluck('id')) }}
    </script>

    <aside>
        @includeIf('admin.users.tabs')
        <div class="mx-auto max-w-7xl py-6">
            @if ( $users[$currentTab]->isNotEmpty() )
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
                                            <th scope="col" class="py-3.5 pl-3 pr-3 text-center text-xs text-gray-500 uppercase tracking-wider">Tenants</th>
                                            <th scope="col" class="px-3 py-3.5 text-right text-xs text-gray-500 uppercase tracking-wider">Creation</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach($users[$currentTab] as $user)
                                            <tr :class="selected.length > 0 && selected.includes({{ $user->id }}) ? 'bg-primary-50 hover:bg-primary-100' : 'even:bg-gray-50 hover:bg-gray-100'">
                                                <td class="relative w-12 px-6 sm:w-16 sm:px-8">
                                                    <div class="absolute inset-y-0 left-0 w-0.5 bg-primary-600" x-show="selected.length > 0 && selected.includes({{ $user->id }})"></div>
                                                    <input 
                                                        type="checkbox" 
                                                        value="{{ $user->id }}" 
                                                        x-model.number="selected" 
                                                        class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 sm:left-6" 
                                                        checked="selected.includes({{ $user->id }})"
                                                    >
                                                </td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm">
                                                    <div class="flex items-center">
                                                        @if ( !empty($user->photo_url) )
                                                            <div class="h-10 w-10 flex-shrink-0">
                                                                <img class="h-10 w-10 rounded-md" src="{{ asset($user->photo_url) }}" alt="">
                                                            </div>
                                                        @else
                                                            <span class="h-10 w-10 flex-shrink-0 {{ $loop->even ? 'bg-white' : 'bg-gray-100' }} border border-gray-200 rounded-md flex justify-center items-center text-gray-500 p-1.5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                                </svg>
                                                            </span>
                                                        @endif
                                                        <div class="ml-4">
                                                            <div class="font-medium text-gray-700">{{ $user->fullname }}</div>
                                                            <div class="text-gray-500">{{ $user->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $user->tenants_count }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-right text-gray-500">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 space-x-2">
                                                    @if ( $user->trashed() )
                                                        <a href="{{ route('admin.users.restore', $user) }}" class="text-yellow-600 hover:text-yellow-900">Restore<span class="sr-only">, {{ $user->fullname }}</span></a>
                                                        <a href="{{ route('admin.users.destroy.force', $user) }}" class="text-red-600 hover:text-red-900">Delete<span class="sr-only">, {{ $user->fullname }}</span></a>
                                                    @else
                                                        <a href="{{ route('admin.users.edit', ['user' => $user, 'currentTab' => 'main']) }}" class="text-primary-600 hover:text-primary-900">Edit<span class="sr-only">, {{ $user->fullname }}</span></a>
                                                        <a href="{{ route('admin.users.destroy.confirm', $user) }}" class="text-red-600 hover:text-red-900">Delete<span class="sr-only">, {{ $user->fullname }}</span></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $users[$currentTab]->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if ( $currentTab === 'all' )
                    <div class="text-center bg-white px-4 py-5 sm:px-6 shadow rounded-lg mt-2">
                        <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-700">No users</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new user.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>
                                New User
                            </a>
                        </div>
                    </div>
                @elseif ( $currentTab === 'trash' )
                    <div class="text-center bg-white px-4 py-5 sm:px-6 shadow rounded-lg mt-2">
                        <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-500">No users trashed</h3>
                    </div>
                @endif
            @endif
        </div>
    </aside>
@endsection