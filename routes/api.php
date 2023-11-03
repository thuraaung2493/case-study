<?php

use App\Enums\Role;
use App\Http\Controllers\API\DownloadController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', LoginController::class);

Route::middleware(['auth:sanctum', 'check.role:field_officer'])->group(function () {
    Route::post('/upload', UploadController::class);
    Route::get('/download', DownloadController::class);
});
