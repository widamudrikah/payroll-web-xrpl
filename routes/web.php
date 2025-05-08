<?php

use App\Http\Controllers\Bendahara\BendaharaController;
use App\Http\Controllers\Bendahara\BendaharaDashboard;
use App\Http\Controllers\Bendahara\ManageEmployeeController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeDashboard;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\BendaharaMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Welcome
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Bendahara
Route::prefix('bendahara')->middleware(['auth', BendaharaMiddleware::class])->group(function() {
    Route::controller(BendaharaController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('bendahara.dashboard');
    });

    // Manage employee
    Route::controller(ManageEmployeeController::class)->group(function() {
        Route::get('/kelola/karyawan', 'index')->name('manage.employee.index');
        Route::get('/tambah/karyawan', 'create')->name('manage.employee.create'); // menampilkan form tambah data
        Route::post('/simpan/karyawan', 'store')->name('manage.employee.store'); // menyimpan data data
        Route::get('/edit/karyawan/{id}', 'edit')->name('manage.employee.edit'); // menampilkan form edit data
        Route::put('/update/karyawan/{id}', 'update')->name('manage.employee.update'); // menampilkan form edit data
    });
});

// Employee
Route::prefix('karyawan')->middleware('auth')->group(function() {
    Route::controller(EmployeeController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('employee.dashboard');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
