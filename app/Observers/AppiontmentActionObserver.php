<?php

namespace App\Observers;

use App\Appiontment;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class AppiontmentActionObserver
{
    public function created(Appiontment $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Appiontment'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Appiontment $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Appiontment'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Appiontment $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Appiontment'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
