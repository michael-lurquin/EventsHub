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
                {!! Form::model($user, ['route' => ['admin.profile.update-personal', $user], 'method' => 'PUT', 'files' => true]) !!}
                    <div class="overflow-hidden shadow sm:rounded-md">
                        @includeWhen($errors->isNotEmpty() || session('success'), 'admin.layouts.flash')
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
                    <h3 class="text-lg font-medium leading-6 text-gray-700">Profile</h3>
                    <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                {!! Form::model($tenant, ['route' => ['admin.profile.update', $user], 'method' => 'PUT', 'files' => true]) !!}
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
                            ])

                            @includeIf('admin.components.form.file', [
                                'fieldname' => 'logo_url',
                                'label' => 'Logo',
                            ])

                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    @includeIf('admin.components.form.textarea', [
                                        'fieldname' => 'address[street]',
                                        'label' => 'Street address',
                                        'autocomplete' => 'street',
                                    ])
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    @includeIf('admin.components.form.input', [
                                        'type' => 'text',
                                        'fieldname' => 'address[post_code]',
                                        'label' => 'ZIP / Postal code',
                                        'autocomplete' => 'post_code',
                                    ])
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    @includeIf('admin.components.form.input', [
                                        'type' => 'text',
                                        'fieldname' => 'address[city]',
                                        'label' => 'City',
                                        'autocomplete' => 'city',
                                    ])
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    @includeIf('admin.components.form.input', [
                                        'type' => 'text',
                                        'fieldname' => 'address[state]',
                                        'label' => 'State / Province',
                                        'autocomplete' => 'state',
                                    ])
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    @includeIf('admin.components.form.select', [
                                        'fieldname' => 'address[country_code]',
                                        'label' => 'Country',
                                        'values' => $countries,
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
@endsection