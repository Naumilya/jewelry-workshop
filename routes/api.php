<?php
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PasswordResetController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CustomJewelryController;
use App\Http\Controllers\API\OrderController;
use Illuminate\Support\Facades\Mail;

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

Route::get("/test-me", function () {
    return 'Hello from Laravel!';
});


Route::prefix('v1')->group(function () {
    Route::apiResource('news', NewsController::class);
});

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
// Route::middleware('auth:api')->group((function () {
//     Route::resource('products', ProductController::class);
// }));

Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'processPayment']);
Route::post('/orders/updateStatus', [OrderController::class, 'updateStatus']);
//
Route::get('/product/{id}', [ProductController::class, 'show']);
//categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/catalog/{name}', [CategoryController::class, 'getByCategory']);
// reset password
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm']);
Route::post('password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');
//


Route::post('/send-email', [CustomJewelryController::class, 'sendEmail']);

Route::get('/test-email', function () {
    $data = [
        'name' => 'Test Name',
        'email' => 'test@example.com',
        'type' => 'repair',
        'message' => 'Test message',
        'images' => [],
    ];

    Mail::to('ilya32005@yandex.ru')->send(new \App\Mail\CustomJewelryMail($data));

    return 'Email sent!';
});
