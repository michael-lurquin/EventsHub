@extends('admin.layouts.app')

@section('title', 'Profile')

@php $breadcrumbs = [] @endphp

@section('content')
    <div class="mt-40">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-700">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-600">This private information.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                {!! Form::model($user, ['route' => 'admin.profile.update-personal', 'method' => 'PUT', 'files' => true]) !!}
                    <div class="overflow-hidden shadow sm:rounded-md">
                        @includeWhen($errors->isNotEmpty(), 'admin.layouts.flash')
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
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
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="btn-primary">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-700">Password</h3>
                    <p class="mt-1 text-sm text-gray-600">Change current password.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                {!! Form::model($user, ['route' => 'admin.profile.update-password', 'method' => 'PUT']) !!}
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-2">
                                    @includeIf('admin.components.form.password', [
                                        'fieldname' => 'current_password',
                                        'label' => 'Current password',
                                        'autocomplete' => 'password',
                                    ])
                                </div>
                                <div class="col-span-6 sm:col-span-2">
                                    @includeIf('admin.components.form.password', [
                                        'fieldname' => 'password',
                                        'label' => 'New password',
                                        'autocomplete' => 'off',
                                    ])
                                </div>
                                <div class="col-span-6 sm:col-span-2">
                                    @includeIf('admin.components.form.password', [
                                        'fieldname' => 'password_confirmation',
                                        'label' => 'Confirmation password',
                                        'autocomplete' => 'off',
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="btn-primary">Update</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


    @if ( $tenant->isOwner() )
        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-700">Profile</h3>
                        <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    {!! Form::model($tenant, ['route' => 'admin.profile.update', 'method' => 'PUT', 'files' => true]) !!}
                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-5 gap-6">
                                    <div class="col-span-5 sm:col-span-2">
                                        @includeIf('admin.components.form.input', [
                                            'type' => 'text',
                                            'fieldname' => 'name',
                                            'label' => 'Name',
                                            'placeholder' => 'My company',
                                        ])
                                    </div>
                                    <div class="col-span-5 sm:col-span-3">
                                        @includeIf('admin.components.form.input', [
                                            'type' => 'text',
                                            'fieldname' => 'subdomain',
                                            'label' => 'Subdomain',
                                            'placeholder' => 'my-company',
                                            'prefix' => 'https://',
                                            'suffix' => config('session.domain'),
                                        ])
                                    </div>
                                    <div class="col-span-5 sm:col-span-3">
                                        @includeIf('admin.components.form.input', [
                                            'type' => 'email',
                                            'fieldname' => 'email',
                                            'label' => 'Email address',
                                            'placeholder' => 'you@example.com',
                                            'autocomplete' => 'email',
                                        ])
                                    </div>
                                </div>

                                @includeIf('admin.components.form.textarea', [
                                    'fieldname' => 'about',
                                    'label' => 'About',
                                    'placeholder' => 'About my company',
                                    'help' => 'Brief description for your company.',
                                    'optional' => true,
                                    'rows' => 5
                                ])

                                @includeIf('admin.components.form.input', [
                                    'type' => 'text',
                                    'fieldname' => 'url',
                                    'label' => 'URL',
                                    'placeholder' => 'https://my-company.com',
                                    'autocomplete' => 'off',
                                    'optional' => true,
                                    'leftIcon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />',
                                ])

                                @includeIf('admin.components.form.file', [
                                    'fieldname' => 'logo_url',
                                    'label' => 'Logo',
                                    'file' => $tenant->logo_url,
                                ])

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        @includeIf('admin.components.form.textarea', [
                                            'fieldname' => 'address[street]',
                                            'label' => 'Street address',
                                            'autocomplete' => 'street',
                                            'optional' => true,
                                        ])
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        @includeIf('admin.components.form.input', [
                                            'type' => 'text',
                                            'fieldname' => 'address[post_code]',
                                            'label' => 'ZIP / Postal code',
                                            'autocomplete' => 'post_code',
                                            'optional' => true,
                                        ])
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        @includeIf('admin.components.form.input', [
                                            'type' => 'text',
                                            'fieldname' => 'address[city]',
                                            'label' => 'City',
                                            'autocomplete' => 'city',
                                            'optional' => true,
                                        ])
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        @includeIf('admin.components.form.input', [
                                            'type' => 'text',
                                            'fieldname' => 'address[state]',
                                            'label' => 'State / Province',
                                            'autocomplete' => 'state',
                                            'optional' => true,
                                        ])
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        @includeIf('admin.components.form.select', [
                                            'fieldname' => 'address[country_code]',
                                            'label' => 'Country',
                                            'values' => $countries,
                                            'optional' => true,
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                <button type="submit" class="btn-primary">Save</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
@endsection