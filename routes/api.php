<?php

use App\Http\Controllers\Api\ApplyController;
use App\Http\Controllers\Api\KarirController;
use App\Models\Apply;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('karir',[KarirController::class,'index']);
// Route::get('karir/{id}',[KarirController::class,'show']);
// Route::post('karir',[KarirController::class,'store']);
// Route::put('karir/{id}',[KarirController::class,'store']);
// Route::delete('karir/{id}',[KarirController::class,'destroy']);

Route::apiResource('karir',KarirController::class)->middleware('CheckHost');
Route::apiResource('apply',ApplyController::class);
Route::put('/apply/{id}/reject', [ApplyController::class, 'reject']);
Route::put('/apply/{id}/accept', [ApplyController::class, 'updateStatus']);

Route::get('apply/accepted', [ApplyController::class, 'accepted']);
Route::get('apply/rejected', [ApplyController::class, 'rejected']);
Route::get('applies/{id}', [ApplyController::class, 'show']);




// Route::get('apply', [ApplyController::class, 'index']);
// Route::get('apply/{id}', [ApplyController::class, 'show']);
// Route::post('apply', [ApplyController::class, 'store']);
// Route::put('apply/{id}', [ApplyController::class, 'update']);
// Route::delete('apply/{id}', [ApplyController::class, 'destroy']);