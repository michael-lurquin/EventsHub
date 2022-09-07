@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
    {!! Form::model($user, ['route' => 'admin.profile.update.password']) !!}
        <aside>
            @includeIf('admin.profile.tabs')

            <div class="mx-auto max-w-7xl py-6">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    @includeWhen($errors->isNotEmpty() || session('success'), 'admin.layouts.flash')
                    <div class="bg-white px-4 py-5 sm:p-6">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-700">Password</h3>
                            <p class="mt-1 text-sm text-gray-500">Change current password.</p>
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-6">
                            <div class="col-span-6 sm:col-span-2">
                                @includeIf('admin.components.form.password', [
                                    'fieldname' => 'current_password',
                                    'label' => 'Current password',
                                    'autocomplete' => 'password',
                                    'leftIcon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />',
                                ])
                            </div>
                            <div class="col-span-6 sm:col-span-2">
                                @includeIf('admin.components.form.password', [
                                    'fieldname' => 'password',
                                    'label' => 'New password',
                                    'autocomplete' => 'off',
                                    'leftIcon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />',
                                ])
                            </div>
                            <div class="col-span-6 sm:col-span-2">
                                @includeIf('admin.components.form.password', [
                                    'fieldname' => 'password_confirmation',
                                    'label' => 'Confirmation password',
                                    'autocomplete' => 'off',
                                    'leftIcon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />',
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    {!! Form::close() !!}
@endsection