@if ( $mobile )
    <a href="{{ route('admin.profile') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
    <button type="button" class="w-full text-left block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white" onclick="document.getElementById('logout-form').submit()">Sign out</button>
@else
    <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
    <button type="button" class="w-full text-left block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2" onclick="document.getElementById('logout-form').submit()">Sign out</button>
@endif

<form action="{{ route('logout') }}" method="POST" id="logout-form">
    @csrf
</form>