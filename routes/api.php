<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthorizedPersonsController;
use App\Http\Controllers\KidController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\MovementsController;
use App\Http\Controllers\ConcubinesController;
use App\Http\Controllers\TutorsController;
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

use App\Http\Controllers\AuthController;

Route::group(['middleware' => 'api'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});


// Route::middleware(['auth:api'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);

    //requests
    Route::get('/requests/', [RequestsController::class, 'index']);
    Route::get('/requests/{id}/', [RequestsController::class, 'watch']);
    Route::post('/requests/', [RequestsController::class, 'register']);
    Route::put('/requests/{id}/', [RequestsController::class, 'update']);
    Route::delete('/requests/{id}/', [RequestsController::class, 'delete']);

    //movements
    Route::get('/movements/', [MovementsController::class, 'index']);
    Route::get('/movements/{id}/', [MovementsController::class, 'watch']);
    Route::post('/movements/', [MovementsController::class, 'register']);
    Route::put('/movements/{id}/', [MovementsController::class, 'update']);
    Route::delete('/movements/{id}/', [MovementsController::class, 'delete']);

// });
