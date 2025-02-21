<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BraidingStyleController;
use App\Http\Controllers\StyleAttributeController;
use App\Http\Controllers\StyleAttributeValueController;
use App\Http\Controllers\StyleImageController;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// User Routes (protected by Sanctum authentication)
Route::middleware('auth:sanctum')->group(function () {
    // User Profile & Management
    Route::get('/user', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
    Route::put('/user/{id}/change-password', [UserController::class, 'changePassword']);
    Route::put('/user/{id}/activate', [UserController::class, 'activateAccount']);
    Route::put('/user/{id}/deactivate', [UserController::class, 'deactivateAccount']);
    Route::put('/user/{id}/restore', [UserController::class, 'restoreAccount']);
    Route::delete('/user/{id}/soft-delete', [UserController::class, 'softDelete']);

    // Optional: Admin Routes for managing users
    Route::get('/users', [UserController::class, 'index'])->middleware('can:viewAny,App\Models\User'); // Only accessible by admin

    // Booking Routes
    Route::apiResource('bookings', BookingController::class);

    // Braiding Style Routes
    Route::apiResource('braiding-styles', BraidingStyleController::class);

    // Style Attribute Routes
    Route::apiResource('style-attributes', StyleAttributeController::class);

    // Style Attribute Value Routes
    Route::apiResource('style-attribute-values', StyleAttributeValueController::class);

    // Style Image Routes
    Route::apiResource('style-images', StyleImageController::class);
});
