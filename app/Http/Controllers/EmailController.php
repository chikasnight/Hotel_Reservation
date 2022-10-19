<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReservationNotification;


class EmailController extends Controller
{
    public function sendEmail()
{
    $email = 'hotelemail@gmail.com';
    $details = [
        'header' => 'New Reservatio Booked',
        'body' => 'This is to notify you that a customer have booked a reservation and paid successfully',
        'url' => 'www.laravel.com',
        'lastline' => 'please take the necessary actions',
    ];
    
    Notification::send($email, new ReservationNotification($details));
    
    return redirect()-> back();

}
}
