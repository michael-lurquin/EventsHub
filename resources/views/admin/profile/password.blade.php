@extends('admin.layouts.app')

@section('title', 'Profile / Password')

@php $breadcrumbs = [] @endphp

@section('content')
    <div class="mt-36">
        @includeIf('admin.profile.tabs')

        <div class="mt-6 lg:mt-8">
            {!! Form::model($user, ['route' => 'admin.profile.update-password', 'method' => 'PUT']) !!}
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
@endsection