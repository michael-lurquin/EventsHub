<div class="relative border-b border-gray-200 pb-5 sm:pb-0">
    <div class="md:flex md:items-center md:justify-between px-4 md:px-0">
        <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:truncate sm:text-3xl sm:tracking-tight">@yield('title')</h2>
        <div class="mt-3 flex md:absolute md:top-3 md:right-0 md:mt-0">
            <a
                href="{{ route('admin.tenants.create') }}"
                class="ml-3 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500"
            >New Tenant</a>
        </div>
    </div>
    <div class="mt-4">
        <!-- Dropdown menu on small screens -->
        <div class="sm:hidden px-4 md:px-0">
            <label for="current-tab" class="sr-only">Select a tab</label>
            <select class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option value="all" selected>All</option>
                <option value="expired">Expired</option>
                <option value="trash">Trash</option>
            </select>
        </div>
        <!-- Tabs at small breakpoint and up -->
        <div class="hidden sm:block">
            <nav class="-mb-px flex space-x-8">
                <a
                    href="{{ route('admin.tenants.index', ['currentTab' => 'all']) }}" 
                    class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ $currentTab === 'all' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                    aria-current="page"
                >
                    <span>All</span>
                    <span class="{{ $currentTab === 'all' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-50 text-gray-400' }} hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">{{ $tenants['expired']->count() }}</span>
                </a>
                <a
                    href="{{ route('admin.tenants.index', ['currentTab' => 'expired']) }}" 
                    class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ $currentTab === 'expired' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                    aria-current="page"
                >
                    <svg class="-ml-0.5 mr-2 h-5 w-5 {{ $currentTab === 'expired' ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }}"
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 24 24" 
                        fill="currentColor" 
                        aria-hidden="true"
                    >
                        <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Expired</span>
                    <span class="{{ $currentTab === 'expired' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-50 text-gray-400' }} hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">{{ $tenants['expired']->count() }}</span>
                </a>
                <a
                    href="{{ route('admin.tenants.index', ['currentTab' => 'trash']) }}" 
                    class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ $currentTab === 'trash' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                    aria-current="page"
                >
                    <svg class="-ml-0.5 mr-2 h-5 w-5 {{ $currentTab === 'trash' ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }}"
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 24 24" 
                        fill="currentColor" 
                        aria-hidden="true"
                    >
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                    </svg>
                    <span>Trash</span>
                    <span class="{{ $currentTab === 'trash' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-50 text-gray-400' }} hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">{{ $tenants['trash']->count() }}</span>
                </a>
            </nav>
        </div>
    </div>
</div>