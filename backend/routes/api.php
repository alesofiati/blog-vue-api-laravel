<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('post', PostController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::get('{slug}/post/{id}', [PostController::class, 'findBySlug'])->where(['slug' => '[a-zA-Z-0-9]+', 'id' => '[0-9]+'])->name('post.slug');
