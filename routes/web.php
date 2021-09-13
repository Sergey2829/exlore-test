<?php

use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/records', [RecordController::class, 'index'])->name('index');
Route::delete('/records/{record}', [RecordController::class, 'destroy'])->name('destroy');
Route::get('/records/{record}', [RecordController::class, 'edit'])->name('edit');
