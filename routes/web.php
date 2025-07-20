<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyUnitController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\SurveyController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','activated'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','activated'])->group(function () {
    Route::get('/company-units', [CompanyUnitController::class, 'index'])->name('company-units.index');
    Route::get('/company-units/create', [CompanyUnitController::class, 'create'])->name('company-units.create');
    Route::get('/company-units/{companyUnit}/edit', [CompanyUnitController::class, 'edit'])->name('company-units.edit');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','activated'])->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','activated'])->group(function () {
    Route::get('/permohonans', [PermohonanController::class, 'index'])->name('permohonans.index');
    Route::get('/permohonans/create', [PermohonanController::class, 'create'])->name('permohonans.create');
    Route::get('/permohonans/{permohonan}/edit', [PermohonanController::class, 'edit'])->name('permohonans.edit');
    Route::get('/permohonans/{permohonan}', [PermohonanController::class, 'show'])->name('permohonans.show');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','activated'])->group(function () {
    Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');
    Route::get('/permohonans/{permohonan}/surveys/create', [SurveyController::class, 'create'])->name('surveys.create');
    Route::get('/surveys/{survey}', [SurveyController::class, 'show'])->name('surveys.show');
    Route::get('/surveys/{survey}/edit', [SurveyController::class, 'edit'])->name('surveys.edit');
});

Route::get('/pending-approval', function () {
    return view('auth.pending-approval');
})->middleware('auth')->name('pending-approval');
