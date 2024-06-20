<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\QueryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');

Route::get('/products/master/{id}', [ProductController::class, 'productsByMaster']);


// запросы
Route::post('/admin/page/query1', [QueryController::class, 'query1']);
Route::post('/admin/page/query2', [QueryController::class, 'query2']);
Route::post('/admin/page/query3', [QueryController::class, 'query3']);
Route::post('/admin/page/query4', [QueryController::class, 'query4']);
Route::post('/admin/page/query5', [QueryController::class, 'query5']);
Route::post('/admin/page/query6', [QueryController::class, 'query6']);
Route::post('/admin/page/query7', [QueryController::class, 'query7']);
Route::post('/admin/page/query8', [QueryController::class, 'query8']);
Route::post('/admin/page/query9', [QueryController::class, 'query9']);
Route::post('/admin/page/query10', [QueryController::class, 'query10']);

