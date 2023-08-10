<?php

use App\Http\Controllers\API\CronJob;
use App\Http\Controllers\API\IdleReportController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth')->group(function () {
// });
Route::get('idle_report', [IdleReportController::class,'index']);
Route::POST('add_tripplan', [CronJob::class,'add_trip_plan']);
