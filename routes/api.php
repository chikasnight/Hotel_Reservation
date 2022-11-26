<?php

use Illuminate\Http\Request;
use App\Models\AddressConfirmation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AvailableRoomController;


//Route::post('/merchant_address_verification', [DashboardController::class, 'verifyMerchantAddress']);
Route::post('/address_upload', [AddressConfirmation::class, 'addressConfirmation']);


Route::post('register',[AdminController::class,'register']);
Route::post('login',[AdminController::class,'login']);
Route::post('images',[GalleryController::class,'reservationImage']);
Route::get('reservations/{availableRoomId}',[AvailableRoomController::class, 'getReservation']);
Route::post('/sendEmail',[EmailController::class,'sendEmail']);


Route::post('stripe',[AvailableRoomController::class, 'stripePost']);


Route::group(['middleware' =>'auth:sanctum'],function(){
    Route::post('logout',[AdminController::class,'logout']);
    Route::post('reservations',[AvailableRoomController::class, 'newReservation']);
    Route::delete('reservations/{availableRoomId}',[AvailableRoomController::class, 'deleteReservation']);
});