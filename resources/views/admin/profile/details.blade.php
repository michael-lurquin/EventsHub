@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
    {!! Form::model($user, ['route' => 'admin.profile.update.details', 'files' => true]) !!}
        <aside>
            @includeIf('admin.profile.tabs')

            <div class="mx-auto max-w-7xl py-6">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    @includeWhen($errors->isNotEmpty() || session('success'), 'admin.layouts.flash')
                    <div class="bg-white px-4 py-5 sm:p-6">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-700">Personal Information</h3>
                            <p class="mt-1 text-sm text-gray-500">This private information.</p>
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-6">
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
                                        class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                        onclick="document.getElementById('photo_url').click()"
                                    >Change</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    {!! Form::close() !!}
@endsection