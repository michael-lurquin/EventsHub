<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

// Dashboard
Route::permanentRedirect('/', '/admin/dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/update-personal', [ProfileController::class, 'updatePersonal'])->name('profile.update-personal');

// Bulk-action
Route::post('/bulk-action/{for}', [DashboardController::class, 'bulkAction'])->name('bulk-action');

// Tenant
Route::resource('/tenants', TenantController::class)->scoped([
    'tenant' => 'subdomain'
]);

// User
Route::resource('/users', UserController::class);