<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\ReportController;
use App\Http\Controllers\TripplanReportController;
use App\Http\Controllers\IdleReportController;
use App\Http\Controllers\ParkingReportController;
use App\Http\Controllers\RoutedeviationReportController;
use App\Http\Controllers\KeyoffKeyonReportController;
use App\Http\Controllers\PlayBackHistoryReportController;
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





Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('/setting', SettingController::class);
    // Route::get('/tripplanreport', TripplanReportController::class);
    // Route::get('idlereport',[IdleReportController::class, 'index'])->name('idlereport.get_data');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('tripplanreport',[TripplanReportController::class,'index'])->name('tripplanreport.index');
    Route::get('trip_plan_cron',[TripplanReportController::class,'trip_plan'])->name('tripplanreport.trip_plan');
    Route::get('idlereport',[IdleReportController::class,'index'])->name('idlereport.index');
    // Route::get('parkingreport',[ParkingReportController::class,'index'])->name('parkingreport.index');
    Route::get('parkingreport',[ParkingReportController::class,'index'])->name('parkingreport.index');
    Route::get('parkingreport_table',[ParkingReportController::class,'getData'])->name('parkingreport.getData');
    Route::get('routedeviationreport',[RoutedeviationReportController::class,'index'])->name('routedeviationreport.index');
    Route::get('keyonkeyoffreport',[KeyoffKeyonReportController::class,'index'])->name('keyonkeyoffreport.index');
    Route::get('playbackhistoryreport',[PlayBackHistoryReportController::class,'index'])->name('playbackhistoryreport.index');
});

require __DIR__.'/auth.php';

Auth::routes();

