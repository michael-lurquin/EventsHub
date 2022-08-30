<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Michaël Lurquin">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans text-sm bg-gray-50 text-gray-600 overflow-hidden h-full">
        <div class="flex h-full" x-data="{ open: false }" @keydown.window.escape="open = false">
            <!-- Mobile -->
            <div 
                class="relative z-40 lg:hidden" 
                role="dialog" 
                aria-modal="true"
                x-show="open"
            >
                <div 
                    x-show="open"
                    x-transition:enter="transition-opacity ease-linear duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-linear duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-600 bg-opacity-75"
                ></div>
        
                <div class="fixed inset-0 z-40 flex">
                    <div 
                        x-show="open"
                        x-transition:enter="transition ease-in-out duration-300 transform"
                        x-transition:enter-start="-translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in-out duration-300 transform"
                        x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="-translate-x-full"
                        class="relative flex w-full max-w-xs flex-1 flex-col bg-white focus:outline-none"
                    >
                        <div 
                            x-show="open"
                            x-transition:enter="ease-in-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in-out duration-300"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute top-0 right-0 -mr-12 pt-2"
                        >
                            <button 
                                type="button" 
                                class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                x-on:click="open = false"
                            >
                                <span class="sr-only">Close sidebar</span>
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
        
                        <div class="h-0 flex-1 overflow-y-auto pt-5 pb-4">
                            <a href="{{ url('/') }}" class="flex flex-shrink-0 items-center px-4">
                                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="">
                                <span class="ml-3 text-lg font-semibold text-indigo-700">{{ config('app.name') }}</span>
                            </a>
                            <nav aria-label="Sidebar" class="mt-5">
                                <div class="space-y-1 px-2">
                                    @includeIf('admin.layouts.nav', ['mobile' => true])
                                </div>
                            </nav>
                        </div>
                        <div class="flex flex-shrink-0 border-t border-gray-200 p-4">
                            <a href="#" class="group block flex-shrink-0">
                                <div class="flex items-center">
                                    <div>
                                        <img class="inline-block h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">{{ auth()->user()->name }}</p>
                                        <p class="text-sm font-medium text-gray-500 group-hover:text-gray-700">View profile</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
        
                    <div class="w-14 flex-shrink-0" aria-hidden="true">
                        <!-- Force sidebar to shrink to fit close icon -->
                    </div>
                </div>
            </div>
        
            <!-- Desktop -->
            <div class="hidden lg:flex lg:flex-shrink-0">
                <div class="flex w-64 flex-col">
                    <div class="flex min-h-0 flex-1 flex-col border-r border-gray-200 bg-white">
                        <div class="flex flex-1 flex-col overflow-y-auto pt-5 pb-4">
                            <a href="{{ url('/') }}" class="flex flex-shrink-0 items-center px-4">
                                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="">
                                <span class="ml-3 text-lg font-semibold text-indigo-700">{{ config('app.name') }}</span>
                            </a>
                            <nav class="mt-5 flex-1" aria-label="Sidebar">
                                <div class="space-y-2 px-2">
                                    @includeIf('admin.layouts.nav', ['mobile' => false])
                                </div>
                            </nav>
                        </div>
                        <div class="flex flex-shrink-0 border-t border-gray-200 p-4">
                            <a href="#" class="group block w-full flex-shrink-0">
                                <div class="flex items-center">
                                    <div>
                                        <img class="inline-block h-9 w-9 rounded-full" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">{{ auth()->user()->name }}</p>
                                        <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">View profile</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="flex min-w-0 flex-1 flex-col overflow-hidden">
                <div class="lg:hidden">
                    <div class="flex items-center justify-between border-b border-gray-200 bg-gray-50 px-4 py-1.5">
                        <a href="{{ url('/') }}" class="flex items-center">
                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="">
                            <span class="ml-3 text-lg font-semibold text-indigo-700">{{ config('app.name') }}</span>
                        </a>
                        <div>
                            <button 
                                type="button" 
                                class="-mr-3 inline-flex h-12 w-12 items-center justify-center rounded-md text-gray-500 hover:text-indigo-700"
                                x-on:click="open = true"
                            >
                                <span class="sr-only">Open sidebar</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="relative z-0 flex flex-1 overflow-hidden">
                    <main class="py-6 px-4 sm:px-6 lg:px-8">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>