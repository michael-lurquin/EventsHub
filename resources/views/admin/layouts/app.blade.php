<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Michaël Lurquin">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if ( !empty($__env->yieldContent('title')) )
            <title>{{ config('app.name') . ' | ' . $__env->yieldContent('title') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans text-sm bg-gray-50 text-gray-600 h-full">
        <div class="min-h-full" x-data="{ selected: [] }">
            <div class="bg-gray-800 px-4 {{ request()->routeIs('admin.profile') ? 'pb-0' : 'pb-32' }}">
                <nav class="bg-gray-800" x-data="{ open: false }">
                    <!-- Desktop -->
                    <div class="mx-auto container">
                        <div class="border-b border-gray-700">
                            <div class="flex h-16 items-center justify-between px-4 sm:px-0">
                                <div class="flex items-center">
                                    <a href="{{ route('welcome') }}" class="flex-shrink-0">
                                        <img class="h-8 w-auto" src="{{ !empty(auth()->user()->currentTenant->logo_url) ? asset(auth()->user()->currentTenant->logo_url) : 'https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=500' }}" alt="{{ config('app.name') }}">
                                    </a>
                                    <div class="hidden lg:block">
                                        <div class="ml-10 flex justify-center items-center space-x-4">
                                            @includeIf('admin.layouts.nav', ['mobile' => false])
                                        </div>
                                    </div>
                                </div>
                                <div class="hidden lg:block">
                                    <div class="ml-4 flex items-center lg:ml-6">
                                        <button type="button" class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                            <span class="sr-only">View notifications</span>
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                            </svg>
                                        </button>

                                        <!-- Profile dropdown -->
                                        <div class="relative ml-3" x-data="{ profile: false }" @keydown.window.escape="profile = false" x-on:click.away="profile = false">
                                            <div>
                                                <button 
                                                    type="button" 
                                                    class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" 
                                                    id="user-menu-button" 
                                                    aria-expanded="false" 
                                                    aria-haspopup="true"
                                                    x-on:click="profile = !profile"
                                                >
                                                    <span class="sr-only">Open user menu</span>
                                                    <img class="h-8 w-8 rounded-full" src="{{ !empty(auth()->user()->photo_url) ? asset(auth()->user()->photo_url) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}" alt="">
                                                </button>
                                            </div>
                                            <div 
                                                class="absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" 
                                                role="menu" 
                                                aria-orientation="vertical" 
                                                aria-labelledby="user-menu-button" 
                                                tabindex="-1"
                                                x-show="profile"
                                                x-transition:enter="transition ease-out duration-100"
                                                x-transition:enter-start="transform opacity-0 scale-95"
                                                x-transition:enter-end="transform opacity-100 scale-100"
                                                x-transition:leave="transition ease-out duration-100"
                                                x-transition:leave-start="transform opacity-100 scale-100"
                                                x-transition:leave-end="transform opacity-0 scale-95"
                                            >
                                                @includeIf('admin.layouts.profile-dropdown', ['mobile' => false])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="-mr-2 flex lg:hidden">
                                    <!-- Mobile menu button -->
                                    <button 
                                        type="button" 
                                        class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" 
                                        aria-controls="mobile-menu" 
                                        aria-expanded="false"
                                        x-on:click="open = !open"
                                    >
                                        <span class="sr-only">Open main menu</span>
                                        <svg class="block h-6 w-6" :class="{ 'hidden': open, 'block': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                        </svg>
                                        <svg class="hidden h-6 w-6" :class="{ 'block': open, 'hidden': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile -->
                    <div class="border-b border-gray-700 lg:hidden mx-auto container" id="mobile-menu" x-show="open">
                        <div class="space-y-1 py-3">
                            @includeIf('admin.layouts.nav', ['mobile' => true])
                        </div>
                        <div class="border-t border-gray-700 pt-4 pb-3">
                            <div class="flex items-center px-5">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="{{ !empty(auth()->user()->photo_url) ? asset(auth()->user()->photo_url) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}" alt="">
                                </div>
                                <div class="ml-3">
                                    <div class="text-base font-medium leading-none text-white">{{ auth()->user()->name }}</div>
                                    <div class="mt-1 text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}</div>
                                </div>
                                <button type="button" class="ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                    <span class="sr-only">View notifications</span>
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-3 space-y-1 px-2">
                                @includeIf('admin.layouts.profile-dropdown', ['mobile' => true])
                            </div>
                        </div>
                    </div>
                </nav>
                <header class="py-10">
                    <div class="mx-auto container">
                        @if ( isset($breadcrumbs) )
                            <div>
                                <nav class="sm:hidden" aria-label="Back">
                                    <a href="{{ back() }}" class="flex items-center text-sm font-medium text-gray-400 hover:text-gray-200">
                                        <svg class="-ml-1 mr-1 h-5 w-5 flex-shrink-0 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                        </svg>
                                        Back
                                    </a>
                                </nav>
                                <nav class="hidden sm:flex" aria-label="Breadcrumb">
                                    <ol role="list" class="flex items-center space-x-2">
                                        <li>
                                            <div class="flex">
                                                <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-400 hover:text-gray-200">Dashboard</a>
                                            </div>
                                        </li>
                                        @foreach($breadcrumbs as $breadcrumb)
                                            <li>
                                                <div class="flex items-center">
                                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                                    </svg>
                                                    <a href="{{ $breadcrumb['link'] }}" class="ml-4 text-sm font-medium text-gray-400 hover:text-gray-200">{{ $breadcrumb['title'] }}</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </nav>
                            </div>
                        @endif
                        <div class="mt-2 md:flex md:items-center md:justify-between">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-2xl font-bold leading-7 text-white sm:truncate sm:text-3xl sm:tracking-tight">@yield('title')</h2>
                            </div>
                            @if ( !empty($actions) )
                                <div class="mt-4 flex flex-shrink-0 md:mt-0 md:ml-4">
                                    @includeWhen(!empty($bulkAction), 'admin.layouts.bulk-action')

                                    @foreach($actions as $action)
                                        <a
                                            href="{{ $action['link'] }}" 
                                            class="{{ !$loop->first ? 'ml-3' : '' }} {{ $action['primary'] ? 'bg-indigo-500 hover:bg-indigo-600 focus:ring-indigo-500' : 'bg-gray-600 hover:bg-gray-700 focus:ring-gray-500' }} inline-flex items-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800"
                                        >
                                            @if ( !empty($action['icon']) )
                                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    {!! $action['icon'] !!}
                                                </svg>
                                            @endif
                                            {{ $action['title'] }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </header>
            </div>

            <main class="-mt-32 px-4">
                <div class="mx-auto container pb-12">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>