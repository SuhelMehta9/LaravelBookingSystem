<?php
/*
namespace App\Observers;

use App\Booking;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class BookingActionObserver
{
    public function created(Booking $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Booking'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
