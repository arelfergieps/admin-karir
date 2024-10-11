<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\SesiController;
use App\Models\Apply;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});
Route::get('/home', function () {
    return redirect('/admin');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('/logout', [SesiController::class, 'logout']);
});



Route::get('karir',[KarirController::class,'index']);
Route::post('karir',[KarirController::class,'store']);
Route::get('karir/{id}',[KarirController::class,'edit']);
Route::put('karir/{id}',[KarirController::class,'update']);
Route::delete('karir/{id}',[KarirController::class,'destroy']);

Route::get('apply',[ApplyController::class,'index']);
Route::post('apply',[ApplyController::class,'store']);
Route::get('apply/{id}',[ApplyController::class,'edit']);
Route::put('apply/{id}',[ApplyController::class,'update']);
Route::delete('apply/{id}',[ApplyController::class,'destroy']);

// Route::post('/tolak/{id}', [ApplyController::class, 'tolak'])->name('tolak');
Route::get('/tolak', function () {
    $data = Apply::all(); // Ambil semua data pelamar, misalnya
    return view('tolak.tolak', compact('data')); // Kirim data ke view
})->name('tolak.halaman');



