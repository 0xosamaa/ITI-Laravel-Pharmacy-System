<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Admin\AreaController;
use Spatie\Permission\Contracts\Permission;

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
    return view('site.landing-page');
})->name('landing-page');

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});



Route::middleware(['auth', 'verified','role:admin|doctor|pharmacist'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //roles
    Route::resource('/roles', RoleController::class);
    //permission
    Route::resource('/permissions', PermissionController::class);
    //orders
    Route::resource('/orders', OrderController::class);
    //pharmacies
    Route::resource('/pharmacies', PharmacyController::class);
    //areas
    Route::resource('/areas', AreaController::class);


});




Route::middleware(['auth', 'role:admin|pharmacist'])->group(function() {
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
    //doctors
    // Route::resource('/doctors', DoctorController::class);

    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

