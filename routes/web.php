<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\GovernorateController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserAdressController;
use App\Http\Controllers\StripeController;


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

Route::get('/', [LandingPageController::class, 'index'])->name('site.landing-page');

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});



Route::middleware(['auth', 'verified', 'role:admin|doctor|pharmacist', 'logs-out-banned-user'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //roles
    Route::resource('/roles', RoleController::class);
    //permission
    Route::resource('/permissions', PermissionController::class);
    //orders
    Route::resource('/orders', OrderController::class);
    //pharmacies
    Route::resource('/pharmacies', PharmacyController::class);
    //governorates
    Route::resource('/governorates', GovernorateController::class);
    //medicines
    Route::resource('/medicines', MedicineController::class);
    // users
    Route::resource('/users', UserController::class);
    // users_addresses
    Route::resource('/user_addresses', UserAdressController::class);
    //stripe
    Route::get('stripe', [StripeController::class, 'stripe'])->name('stripe');
    Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

    Route::get('checkOut/{id}', [OrderController::class, 'checkOut'])->name('checkOut');

});


Route::middleware(['auth', 'role:admin|pharmacist'])->prefix('admin')->name('admin.')->group(function () {
    // //doctors
    Route::resource('/doctors', DoctorController::class);
    Route::patch('/doctors/ban/{doctor}', [DoctorController::class, 'ban'])->name('doctors.ban');
    Route::patch('/doctors/unban/{doctor}', [DoctorController::class, 'unban'])->name('doctors.unban');
    Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
});

Route::name('site.')->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/shop/{medicine:slug}', [ShopController::class, 'show'])->name('shop.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
