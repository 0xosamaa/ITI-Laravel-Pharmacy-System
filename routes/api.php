<?php
use App\Models\User;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\MedicineController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\OrderController;
use Illuminate\Validation\ValidationException;

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

Route::post('/register', [UserController::class, 'register']);
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Protected API routes
    Route::get('/', [UserController::class, 'index']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::get('/orders', [OrderController::class, 'getOrdersByUser']);
    Route::post('/orders', [OrderController::class, 'AddNewOrder']);
    Route::get('/medicines', [MedicineController::class, 'index']);
    Route::get('/medicines/{medicine}', [MedicineController::class, 'show']);
    Route::get('/cart', [CartController::class, 'index']);

    Route::resource('/user/{id}/addresses', AddressController::class);
});



Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});


