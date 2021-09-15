<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('records', RecordController::class);
Route::get('category-records/{category}', [RecordController::class, 'getByCategory'])
    ->name('category.records');
Route::get('user-records/{user}', [RecordController::class, 'getByUser'])
    ->name('user.records')->middleware('check.manager');

Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('employees', [EmployeeController::class, 'store'])->name('employees.store');
