<form 
    action="{{ route('admin.bulk-action', ['for' => $bulkAction]) }}" 
    method="POST" 
    class="mr-4" 
    x-data="{ bulkAction: false, bulkActionValue: '' }" 
    @keydown.window.escape="bulkAction = false" 
    x-on:click.away="bulkAction = false" 
    x-show="selected.length > 0"
    id="bulk-action"
>
    @csrf
    <div class="relative">
        <button 
            type="button" 
            class="relative w-48 cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" 
            aria-haspopup="listbox" 
            aria-expanded="true" 
            aria-labelledby="listbox-label"
            x-on:click="bulkAction = !bulkAction"
        >
            <span class="block truncate">Mass action</span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>
        <ul 
            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" 
            tabindex="-1" 
            role="listbox" 
            aria-labelledby="listbox-label" 
            aria-activedescendant="listbox-option-3"
            x-show="bulkAction"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <li 
                class="relative cursor-default select-none py-2 px-3 text-gray-600 hover:bg-gray-100"
                id="listbox-option-0" 
                role="option" 
                x-on:click="bulkActionValue = 'feature test'; bulkAction = false"
            >
                <span class="block truncate font-normal">Feature test</span>
            </li>
        </ul>
    </div>
    <input type="text" x-model="selected" class="hidden" name="selected" />
    <input type="text" x-model="bulkActionValue" class="hidden" x-if="bulkActionValue !== '' ? document.getElementById('bulk-action').submit() : ''" name="bulk-action" />
</form>