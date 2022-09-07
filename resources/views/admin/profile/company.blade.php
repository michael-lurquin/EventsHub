@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
    {!! Form::model($tenant, ['route' => 'admin.profile.update.company', 'files' => true]) !!}
        <aside>
            @includeIf('admin.profile.tabs')

            <div class="mx-auto max-w-7xl py-6">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    @includeWhen($errors->isNotEmpty() || session('success'), 'admin.layouts.flash')
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-700">Profile</h3>
                            <p class="mt-1 text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p>
                        </div>
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
                                    'leftIcon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />',
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
                            'leftIcon' => '
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />',
                        ])

                        @includeIf('admin.components.form.file', [
                            'fieldname' => 'logo_url',
                            'label' => 'Logo',
                            'file' => auth()->user()->currentTenant->logo_url,
                            'optional' => true,
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
                                    'values' => listOfCountries(),
                                    'optional' => true,
                                    'empty' => true,
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    {!! Form::close() !!}
@endsection