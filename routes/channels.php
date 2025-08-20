<?php

use Illuminate\Support\Facades\Broadcast;

// Користувач може слухати тільки свій канал приватних повідомлень
Broadcast::channel('private-messages.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

