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
Route::post('/profile/details', [ProfileController::class, 'updateDetails'])->name('profile.update.details');
Route::get('/profile/company', [ProfileController::class, 'company'])->name('profile.company');
Route::post('/profile/company', [ProfileController::class, 'updateCompany'])->name('profile.update.company');
Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

// Bulk-action
Route::post('/bulk-action/{for}', [DashboardController::class, 'bulkAction'])->name('bulk-action');

// Tenant
Route::resource('/tenants', TenantController::class)->scoped([
    'tenant' => 'subdomain'
])->only(['create', 'store', 'destroy']);
Route::get('/tenants/tab/{currentTab}', [TenantController::class, 'index'])->name('tenants.index');
Route::get('/tenants/{tenant}/tab/{currentTab?}', [TenantController::class, 'edit'])->name('tenants.edit');
Route::put('/tenants/{tenant}/tab/{currentTab}', [TenantController::class, 'update'])->name('tenants.update');
Route::get('/tenants/{tenant}/delete/confirm', [TenantController::class, 'confirmDestroy'])->name('tenants.destroy.confirm');
Route::get('/tenants/{tenant}/restore', [TenantController::class, 'restore'])->withTrashed()->name('tenants.restore');
Route::get('/tenants/{tenant}/delete/force', [TenantController::class, 'forceDestroy'])->withTrashed()->name('tenants.destroy.force');


// User
Route::resource('/users', UserController::class);