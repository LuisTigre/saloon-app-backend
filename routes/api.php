<?php

use App\Http\Controllers\AttributePricingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HairstyleController;
use App\Http\Controllers\HairstyleAttributeController;
use App\Http\Controllers\HairstyleAttributeValueController;
use App\Http\Controllers\HairstyleImageController;
use App\Http\Controllers\BookingAttributeValueController;

// Test Route
Route::get('/test', function (Request $request) {
    return 'This is a test route';
});

// Authentication Routes 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Protected Routes (only for authenticated users)
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

    // Admin Routes for User Management
    Route::get('/users', [UserController::class, 'index'])->middleware('can:viewAny,App\Models\User');

    // Booking Management
    Route::apiResource('bookings', BookingController::class);

    // Style Attributes
});

Route::apiResource('hairstyles', HairstyleController::class);
Route::get('/hairstyles/{id}/showDetails', [HairstyleController::class, 'showDetails']);

Route::get('/hairstyles-attributes/{id}/values', [HairstyleAttributeController::class, 'getHairstyleAttributesValue']);

Route::apiResource('hairstyle-attributes', HairstyleAttributeController::class);
Route::apiResource('hairstyle-attribute-values', HairstyleAttributeValueController::class);
Route::apiResource('hairstyle-images', HairstyleImageController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('booking-hairstyle-attributes', BookingAttributeValueController::class);
Route::apiResource('hairstyle-attribute-pricing', AttributePricingController::class);
Route::apiResource('booking-attribute-values', BookingAttributeValueController::class);


// Post Routes
Route::apiResource('posts', PostController::class);
