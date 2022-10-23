<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AvailableRoomController;




Route::post('register',[AdminController::class,'register']);
Route::post('login',[AdminController::class,'login']);
Route::post('images',[GalleryController::class,'reservationImage']);
Route::get('reservations/{availableRoomId}',[AvailableRoomController::class, 'getReservation']);
Route::post('/sendEmail',[EmailController::class,'sendEmail']);

Route::group(['middleware' =>'auth:sanctum'],function(){
    Route::post('logout',[AdminController::class,'logout']);
    Route::post('reservations',[AvailableRoomController::class, 'newReservation']);
    Route::delete('reservations/{availableRoomId}',[AvailableRoomController::class, 'deleteReservation']);
});