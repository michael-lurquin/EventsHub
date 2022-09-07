@if ( $mobile )
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Dashboard</a>
    <a href="{{ route('admin.tenants.index') }}" class="{{ request()->routeIs('admin.tenants.*') ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium">Tenants</a>
    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium">Users</a>
    <a href="#" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium">Pages</a>
    <a href="#" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium">Streams &amp; Lives</a>
    <a href="#" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium">Analytics</a>
    <a href="#" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium">Settings</a>
    @can('viewHorizon')
        <a href="{{ route('admin.horizon') }}" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium">Jobs</a>
    @endcan
    @can('viewLogViewer')
        <a href="{{ url('log-viewer') }}" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium">Logs</a>
    @endcan
@else
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Dashboard</a>
    <a href="{{ route('admin.tenants.index') }}" class="{{ request()->routeIs('admin.tenants.*') ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }} px-3 py-2 rounded-md text-sm font-medium">Tenants</a>
    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }} px-3 py-2 rounded-md text-sm font-medium">Users</a>
    <a href="#" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Pages</a>
    <a href="#" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Streams &amp; Lives</a>
    <a href="#" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Analytics</a>
    <a href="#" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Settings</a>
    @can('viewHorizon')
        <a href="{{ route('admin.horizon') }}" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Jobs</a>
    @endcan
    @can('viewLogViewer')
        <a href="{{ url('log-viewer') }}" class="text-gray-500 hover:bg-gray-100 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Logs</a>
    @endcan
@endif

