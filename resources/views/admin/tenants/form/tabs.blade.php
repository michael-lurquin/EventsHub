<div class="relative border-b border-gray-200 pb-5 sm:pb-0 mb-2">
    <div class="md:flex md:items-center md:justify-between px-4 md:px-0">
        <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:truncate sm:text-3xl sm:tracking-tight">@yield('title')</h2>
        <div class="mt-3 flex md:absolute md:top-3 md:right-0 md:mt-0">
           <a 
                href="{{ route('admin.tenants.index', ['currentTab' => 'all']) }}" 
                class="inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-gray-300 bg-white text-gray-600 hover:bg-gray-50 focus:ring-indigo-500"
            >Cancel</a>

            @if ( !empty($tenant) && $currentTab )
                @php $currentPositionTab = array_search($currentTab, $tabs) @endphp
                @if ( $currentPositionTab === 0 )
                    <button
                        type="submit"
                        class="ml-3 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500"
                    >
                        Next
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ml-2 -mr-1 h-5 w-5">
                            <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @elseif ( $currentPositionTab < count($tabs) - 1 )
                    <a
                        href="{{ route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => $tabs[$currentPositionTab - 1]]) }}"
                        class="ml-3 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="-ml-1 mr-2 h-5 w-5">
                            <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z" clip-rule="evenodd" />
                        </svg>
                        Previous
                    </a>
                    <button
                        type="submit"
                        class="ml-3 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500"
                    >
                        Next
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ml-2 -mr-1 h-5 w-5">
                            <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @else
                    <a
                        href="{{ route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => $tabs[$currentPositionTab - 1]]) }}"
                        class="ml-3 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="-ml-1 mr-2 h-5 w-5">
                            <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z" clip-rule="evenodd" />
                        </svg>
                        Previous
                    </a>
                    <button
                        type="submit"
                        class="ml-3 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="-ml-1 mr-2 h-5 w-5">
                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                        </svg>
                        Save
                    </button>
                @endif
            @else
                <button
                    type="submit"
                    class="ml-3 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500"
                >
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ml-2 -mr-1 h-5 w-5">
                        <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
                    </svg>
                </button>
            @endif
        </div>
    </div>
    <div class="mt-4">
        @if ( !empty($tenant) )
            <!-- Dropdown menu on small screens -->
            <div class="sm:hidden px-4 md:px-0">
                <label for="current-tab" class="sr-only">Select a tab</label>
                <select class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option value="main" selected>Main</option>
                    <option value="address">Address</option>
                    <option value="owner">Owner</option>
                </select>
            </div>
            <!-- Tabs at small breakpoint and up -->
            <div class="hidden sm:block">
                <nav class="-mb-px flex space-x-8">
                    <a
                        href="{{ route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => 'main']) }}" 
                        class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ $currentTab === 'main' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                        aria-current="page"
                    >
                        <span>Main</span>
                    </a>
                    <a
                        href="{{ route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => 'address']) }}" 
                        class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ $currentTab === 'address' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                        aria-current="page"
                    >
                        <svg class="-ml-0.5 mr-2 h-5 w-5 {{ $currentTab === 'address' ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }}"
                            xmlns="http://www.w3.org/2000/svg" 
                            viewBox="0 0 24 24" 
                            fill="currentColor" 
                            aria-hidden="true"
                        >
                            <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 000 1.5v16.5h-.75a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5h-.75V3.75a.75.75 0 000-1.5h-15zM9 6a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H9zm-.75 3.75A.75.75 0 019 9h1.5a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM9 12a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H9zm3.75-5.25A.75.75 0 0113.5 6H15a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zM13.5 9a.75.75 0 000 1.5H15A.75.75 0 0015 9h-1.5zm-.75 3.75a.75.75 0 01.75-.75H15a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zM9 19.5v-2.25a.75.75 0 01.75-.75h4.5a.75.75 0 01.75.75v2.25a.75.75 0 01-.75.75h-4.5A.75.75 0 019 19.5z" clip-rule="evenodd" />
                        </svg>
                        <span>Adddress</span>
                    </a>
                    <a
                        href="{{ route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => 'owner']) }}" 
                        class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ $currentTab === 'owner' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                        aria-current="page"
                    >
                        <svg class="-ml-0.5 mr-2 h-5 w-5 {{ $currentTab === 'owner' ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }}"
                            xmlns="http://www.w3.org/2000/svg" 
                            viewBox="0 0 24 24" 
                            fill="currentColor" 
                            aria-hidden="true"
                        >
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                        </svg>
                        <span>Owner</span>
                    </a>
                </nav>
            </div>
        @else
            <div class="hidden sm:block">
                <nav class="-mb-px flex space-x-8">
                    <div
                        class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none border-indigo-500 text-indigo-600"
                        aria-current="page"
                    >
                        <span>Main</span>
                    </div>
                </nav>
            </div>
        @endif
    </div>
</div>