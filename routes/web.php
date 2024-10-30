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
    Route::get('/admin', [AdminController::class, 'dashboard']);
    Route::get('/admin/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('/logout', [SesiController::class, 'logout']);



});



Route::get('karir',[KarirController::class,'index']);
Route::post('karir',[KarirController::class,'store']);
Route::get('karir/{id}',[KarirController::class,'edit']);
Route::put('karir/{id}',[KarirController::class,'update']);
Route::delete('karir/{id}',[KarirController::class,'destroy']);


Route::get('/hidden_karir', [KarirController::class, 'hiddenKarir'])->name('karir.hidden');


Route::get('apply',[ApplyController::class,'index']);
Route::post('apply',[ApplyController::class,'store']);
Route::get('apply/{id}',[ApplyController::class,'edit']);
Route::put('apply/{id}',[ApplyController::class,'update']);
Route::delete('apply/{id}',[ApplyController::class,'destroy']);
Route::get('view_cv/{id}', [ApplyController::class, 'view_cv'])->name('admin.view_cv');
Route::post('apply/{id}/accept', [ApplyController::class, 'accept']);
Route::post('apply/{id}/reject', [ApplyController::class, 'reject']);


Route::get('/terima', [ApplyController::class, 'terima'])->name('apply.terima');
Route::get('/tolak', [ApplyController::class, 'tolak'])->name('apply.tolak');

// Route::get('/apply/accepted', [ApplyController::class, 'accepted'])->name('apply.accepted');
// Route::get('/apply/rejected', [ApplyController::class, 'rejected'])->name('apply.rejected');



// Route::post('/tolak/{id}', [ApplyController::class, 'tolak'])->name('tolak');
// Route::get('/tolak', function () {
//     $data = Apply::all(); // Ambil semua data pelamar, misalnya
//     return view('tolak.tolak', compact('data')); // Kirim data ke view
// })->name('tolak.halaman');



