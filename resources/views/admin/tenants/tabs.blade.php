<div class="relative border-b border-gray-200 pb-5 sm:pb-0">
    <div class="md:flex md:items-center md:justify-between px-4 md:px-0">
        <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:truncate sm:text-3xl sm:tracking-tight">@yield('title')</h2>
        <div class="mt-3 flex md:absolute md:top-3 md:right-0 md:mt-0">
            <a
                href="{{ route('admin.tenants.create') }}"
                class="ml-3 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-transparent bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500"
            >
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
                New Tenant
            </a>
        </div>
    </div>
    <div class="mt-4">
        <!-- Dropdown menu on small screens -->
        <div class="sm:hidden px-4 md:px-0">
            <label for="current-tab" class="sr-only">Select a tab</label>
            <select class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
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
                    class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ $currentTab === 'all' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                    aria-current="page"
                >
                    <span>All</span>
                    <span class="{{ $currentTab === 'all' ? 'bg-primary-100 text-primary-600' : 'bg-gray-50 text-gray-400' }} hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">{{ $tenants['all']->total() }}</span>
                </a>
                <a
                    href="{{ route('admin.tenants.index', ['currentTab' => 'expired']) }}" 
                    class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ $currentTab === 'expired' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                    aria-current="page"
                >
                    <svg class="-ml-0.5 mr-2 h-5 w-5 {{ $currentTab === 'expired' ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-500' }}"
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 24 24" 
                        fill="currentColor" 
                        aria-hidden="true"
                    >
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                    </svg>
                    <span>Expired</span>
                    <span class="{{ $currentTab === 'expired' ? 'bg-primary-100 text-primary-600' : 'bg-gray-50 text-gray-400' }} hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">{{ $tenants['expired']->total() }}</span>
                </a>
                <a
                    href="{{ route('admin.tenants.index', ['currentTab' => 'trash']) }}" 
                    class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ $currentTab === 'trash' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                    aria-current="page"
                >
                    <svg class="-ml-0.5 mr-2 h-5 w-5 {{ $currentTab === 'trash' ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-500' }}"
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 24 24" 
                        fill="currentColor" 
                        aria-hidden="true"
                    >
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                    </svg>
                    <span>Trash</span>
                    <span class="{{ $currentTab === 'trash' ? 'bg-primary-100 text-primary-600' : 'bg-gray-50 text-gray-400' }} hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">{{ $tenants['trash']->total() }}</span>
                </a>
            </nav>
        </div>
    </div>
</div>