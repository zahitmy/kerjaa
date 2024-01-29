<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/check-token', function (Request $request) {
    return response()->json(['message' => 'Token is valid'], 200);
});
//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::get('/get-presensi',  [App\Http\Controllers\API\PresensiController::class, 'getPresensis']);

    Route::post('save-presensi', [App\Http\Controllers\API\PresensiController::class, 'savePresensi']);
    Route::post('/clock-in', [App\Http\Controllers\API\JobController::class, 'clockIn']);
    Route::post('/clock-out/{jobId}', [App\Http\Controllers\API\JobController::class, 'clockOut']);
    Route::post('/get-status', [App\Http\Controllers\API\JobController::class, 'getStatus']);
    Route::get('/live-locations', [App\Http\Controllers\API\LiveLocationController::class, 'index']);
    Route::post('/user-locations', [App\Http\Controllers\API\UserLocationController::class, 'store']);
    Route::get('/user-locations', [App\Http\Controllers\API\UserLocationController::class, 'index']);


    //API untuk form builder
    Route::get('/form-definition', [App\Http\Controllers\API\FormController::class, 'getFormDefinition']);
    Route::get('/form-clockin', [App\Http\Controllers\API\FormController::class, 'getFormClockIn']);
    Route::get('/form-exit', [App\Http\Controllers\API\FormController::class, 'getFormExitForm']);


});