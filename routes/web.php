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
use App\Http\Controllers\VehicleController;
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

Route::get('get_apemcl_data',[PlayBackHistoryReportController::class,'get_apemcl_data'])->name('playbackhistoryreport.get_apemcl_data');
Route::get('demo_test',[PlayBackHistoryReportController::class,'demo_test'])->name('playbackhistoryreport.demo_test');


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    Route::get('all_vehicles', [DashboardController::class,'all_vehicles'])->name('dashboard.all_vehicles');
    Route::resource('/setting', SettingController::class);
    // Route::get('get_apemcl_data', DashboardController::class,'get_apemcl_data')->name('dashboard');
    // Route::get('/tripplanreport', TripplanReportController::class);
    // Route::get('idlereport',[IdleReportController::class, 'index'])->name('idlereport.get_data');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('tripplanreport',[TripplanReportController::class,'index'])->name('tripplanreport.index');
    Route::get('trip_plan_cron',[TripplanReportController::class,'trip_plan'])->name('tripplanreport.trip_plan');
    Route::post('trip_plan_table',[TripplanReportController::class,'getData'])->name('trip_plan.getData');
    Route::get('idlereport',[IdleReportController::class,'index'])->name('idlereport.index');
    Route::get('idlereport_table',[IdleReportController::class,'getData'])->name('idlereport.getData');
    // Route::get('parkingreport',[ParkingReportController::class,'index'])->name('parkingreport.index');
    Route::get('parkingreport',[ParkingReportController::class,'index'])->name('parkingreport.index');
    Route::get('parkingreport_table',[ParkingReportController::class,'getData'])->name('parkingreport.getData');
    Route::get('routedeviationreport',[RoutedeviationReportController::class,'index'])->name('routedeviationreport.index');
    Route::get('keyonkeyoffreport',[KeyoffKeyonReportController::class,'index'])->name('keyonkeyoffreport.index');
    Route::get('playbackhistoryreport',[PlayBackHistoryReportController::class,'index'])->name('playbackhistoryreport.index');
    Route::get('vehicle',[VehicleController::class,'index'])->name('vehicle.index');
    Route::get('vehicle_table',[VehicleController::class,'getData'])->name('vehicle.getData');
    Route::get('create',[VehicleController::class,'create'])->name('vehicle.create');
    Route::post('store',[VehicleController::class,'store'])->name('vehicle.store');
    Route::get('edit',[VehicleController::class,'edit'])->name('vehicle.edit');
    Route::post('update',[VehicleController::class,'update'])->name('vehicle.update');


});

require __DIR__.'/auth.php';

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
