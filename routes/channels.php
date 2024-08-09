<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
}, ['guards' => ['api', 'web']]);


Broadcast::channel('notify.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
