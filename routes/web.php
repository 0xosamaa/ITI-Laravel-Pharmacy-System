<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\AreaController;
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



Route::middleware(['auth', 'role:admin|doctor|pharmacist'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::resource('/roles', RoleController::class)->middleware(['auth', 'verified']);
    Route::resource('/permissions', PermissionController::class)->middleware(['auth', 'verified']);

    Route::resource('/orders', OrderController::class)->middleware(['auth', 'verified']);

    //pharmacies
    Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
    Route::get('/pharmacies/create', [PharmacyController::class, 'create'])->name('pharmacies.create');
    Route::post('/pharmacies', [PharmacyController::class, 'store'])->name('pharmacies.store');
    // Route::get('/pharmacies/{id}/edit', [PharmacyController::class, 'edit'])->name('pharmacies.edit');
    // Route::put('/pharmacies/{id}', [PharmacyController::class, 'update'])->name('pharmacies.update');






    Route::resource('/orders', OrderController::class)->middleware(['auth', 'verified']);

//Areas
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
    Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('areas.edit');
    Route::put('/areas/{id}', [AreaController::class, 'update'])->name('areas.update');
    Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');


    // Route::resource('/areas/{id}/edit', [AreaController::class, 'edit'])->middleware(['auth', 'verified']);
});




Route::middleware(['auth', 'role:admin|pharmacist'])->group(function() {
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



