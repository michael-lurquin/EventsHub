<aside>
    <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
        <h3 class="text-2xl font-bold leading-7 text-gray-800 sm:truncate sm:text-3xl sm:tracking-tight">@yield('title')</h3>
        <div class="mt-3 flex sm:mt-0 sm:ml-4">
            <a 
                href="{{ route('admin.users.index', ['currentTab' => 'all']) }}" 
                class="inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-gray-300 bg-white text-gray-600 hover:bg-gray-50 focus:ring-primary-500"
            >Cancel</a>
            <button
                type="submit"
                class="ml-3 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 border-transparent bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="-ml-1 mr-2 h-5 w-5">
                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                </svg>
                Save
            </button>
        </div>
    </div>

    <div class="mx-auto max-w-7xl py-6">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            @includeWhen($errors->isNotEmpty() || session('success'), 'admin.layouts.flash')
            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    @if ( empty($user) && $hasTenant )
                        <input type="hidden" name="tenant_id" value="{{ $hasTenant }}">
                    @endif

                    <div class="col-span-6 sm:col-span-3">
                        @includeIf('admin.components.form.input', [
                            'type' => 'text',
                            'fieldname' => 'first_name',
                            'label' => 'First name',
                            'autocomplete' => 'first_name',
                        ])
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        @includeIf('admin.components.form.input', [
                            'type' => 'text',
                            'fieldname' => 'last_name',
                            'label' => 'Last name',
                            'autocomplete' => 'last_name',
                        ])
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        @includeIf('admin.components.form.input', [
                            'type' => 'email',
                            'fieldname' => 'email',
                            'label' => 'Email address',
                            'autocomplete' => 'email',
                            'leftIcon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />',
                        ])
                    </div>

                    <div class="sm:col-span-6">
                        <label for="photo" class="block text-sm text-gray-700">Photo</label>
                        <div class="mt-1 flex items-center">
                            <span class="h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                                @if ( !empty($user->photo_url) )
                                    <img src="{{ asset($user->photo_url) }}" alt="" class="h-full w-full">
                                @else
                                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                @endif
                            </span>
                            <input type="file" name="photo_url" class="hidden" id="photo_url">
                            <button 
                                type="button" 
                                class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                                onclick="document.getElementById('photo_url').click()"
                            >Change</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>