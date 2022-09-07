<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

// Dashboard
Route::permanentRedirect('/', '/admin/dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Profile
Route::get('/profile/details', [ProfileController::class, 'details'])->name('profile.details');
Route::put('/profile/details', [ProfileController::class, 'updateDetails'])->name('profile.update.details');
Route::get('/profile/company', [ProfileController::class, 'company'])->name('profile.company');
Route::put('/profile/company', [ProfileController::class, 'updateCompany'])->name('profile.update.company');
Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

// Bulk-action
Route::post('/bulk-action/{for}', [DashboardController::class, 'bulkAction'])->name('bulk-action');

// Tenant
Route::resource('/tenants', TenantController::class)->scoped([
    'tenant' => 'subdomain'
]);

// User
Route::resource('/users', UserController::class);