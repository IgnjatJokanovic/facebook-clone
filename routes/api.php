<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Translation\MessageCatalogue;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// User routes
Route::prefix('user')->group(function(){
    Route::post('/create', [UserController::class, 'create']);
    Route::post('/search', [UserController::class, 'search']);
    Route::get('/show/{slug}', [UserController::class, 'show']);
    Route::post('/delete', [UserController::class, 'delete']);
    Route::post('/update', [UserController::class, 'update']);
});

// Auth routes
Route::prefix('auth')->group(function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Friend routes
Route::prefix('friend')->group(function(){
    Route::post('/add', [FriendController::class, 'add']);
    Route::post('/accept', [FriendController::class, 'accept']);
    Route::post('/decline', [FriendController::class, 'decline']);
    Route::post('/search', [FriendController::class, 'search']);
});

// Post routes
Route::prefix('post')->group(function(){
    Route::get('/', [PostController::class, 'index']);
    Route::get('/show/{slug}', [PostController::class, 'show']);
    Route::get('/user/{slug}', [PostController::class, 'userRelated']);
    Route::post('/create', [PostController::class, 'create']);
    Route::post('/delete', [PostController::class, 'delete']);
    Route::post('/update', [PostController::class, 'update']);
});

// Comment routes
Route::prefix('comment')->group(function(){
    Route::post('/create', [CommentController::class, 'create']);
    Route::post('/update', [CommentController::class, 'update']);
    Route::post('/delete', [CommentController::class, 'delete']);
});

// Reaction routes
Route::prefix('reaction')->group(function(){
    Route::post('/create', [ReactionController::class, 'create']);
    Route::post('/update', [ReactionController::class, 'update']);
    Route::post('/delete', [ReactionController::class, 'delete']);
});

// Message routes
Route::prefix('message')->group(function(){
    Route::post('/create', [MessageController::class, 'create']);
});
