<?php

use App\Http\Controllers\ArchivesController;
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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\ArchivesController::class, 'index'])->name('home');
Route::get('/detail/{id}', [ArchivesController::class, 'detail']);
Route::get('/create', [ArchivesController::class, 'create']);
Route::get('/edit/{id}', [ArchivesController::class, 'edit']);
Route::put('/update/{id}', [ArchivesController::class, 'update']);
Route::post('/store', [ArchivesController::class, 'store']);
Route::delete('/archives/bulk-delete', [ArchivesController::class, 'bulkDelete'])->name('archives.bulkDelete');
