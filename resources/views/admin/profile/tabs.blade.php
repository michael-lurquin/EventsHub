<div class="relative border-b border-gray-200 pb-5 sm:pb-0 mb-2">
    <div class="md:flex md:items-center md:justify-between px-4 md:px-0">
        <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:truncate sm:text-3xl sm:tracking-tight">@yield('title')</h2>
        <div class="mt-3 flex md:absolute md:top-3 md:right-0 md:mt-0">
            <a 
                href="{{ route('admin.dashboard') }}" 
                class="inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-gray-300 bg-white text-gray-600 hover:bg-gray-50 focus:ring-indigo-500"
            >Cancel</a>
            <button
                type="submit"
                class="ml-3 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500"
            >Save</button>
        </div>
    </div>
    <div class="mt-4">
        <!-- Dropdown menu on small screens -->
        <div class="sm:hidden px-4 md:px-0">
            <label for="current-tab" class="sr-only">Select a tab</label>
            <select x-model="currentTab" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option value="details" selected>My details</option>
                <option value="company">Company</option>
                <option value="password">Password</option>
            </select>
        </div>
        <!-- Tabs at small breakpoint and up -->
        <div class="hidden sm:block">
            <nav class="-mb-px flex space-x-8">
                <a
                    href="{{ route('admin.profile.details') }}" 
                    class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ request()->routeIs('admin.profile.details') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                    aria-current="page"
                >
                    <svg 
                        class="-ml-0.5 mr-2 h-5 w-5 {{ request()->routeIs('admin.profile.details') ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" 
                        fill="currentColor" 
                        aria-hidden="true"
                    >
                        <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                    </svg>
                    <span>My details</span>
                </a>
                <a
                    href="{{ route('admin.profile.company') }}" 
                    class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ request()->routeIs('admin.profile.company') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                    aria-current="page"
                >
                    <svg class="-ml-0.5 mr-2 h-5 w-5 {{ request()->routeIs('admin.profile.company') ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }}"
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 20 20" 
                        fill="currentColor" 
                        aria-hidden="true"
                    >
                        <path fill-rule="evenodd" d="M4 16.5v-13h-.25a.75.75 0 010-1.5h12.5a.75.75 0 010 1.5H16v13h.25a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75v-2.5a.75.75 0 00-.75-.75h-2.5a.75.75 0 00-.75.75v2.5a.75.75 0 01-.75.75h-3.5a.75.75 0 010-1.5H4zm3-11a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zM7.5 9a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1zM11 5.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zm.5 3.5a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Company</span>
                </a>
                <a
                    href="{{ route('admin.profile.password') }}" 
                    class="group inline-flex items-center whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm select-none {{ request()->routeIs('admin.profile.password') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 cursor-pointer' }}"
                    aria-current="page"
                >
                    <svg class="-ml-0.5 mr-2 h-5 w-5 {{ request()->routeIs('admin.profile.password') ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }}"
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 20 20" 
                        fill="currentColor" 
                        aria-hidden="true"
                    >
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Password</span>
                </a>
            </nav>
        </div>
    </div>
</div>