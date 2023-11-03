<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\LoginController;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/admin/login', 'admin.auth.login');

Route::post('/admin/login', LoginController::class)->name('login');

Route::middleware(['auth', 'check.role:branch_manager'])->group(function () {

    Route::get('/admin/clients', ClientController::class)->name('clients');
    Route::get('/admin/loans', LoanController::class)->name('loans');
});
