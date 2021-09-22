<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('private-chat', function ($user){
    return true;
});
Broadcast::channel('chat', function ($user){
    return $user->hasPermissionTo('Просмотр админ чата');
});
Broadcast::channel('chat.{id}', function ($user) {
    return $user->hasPermissionTo('Просмотр админ чата');
});
//Broadcast::channel('chat', function ($user) {
//    $avatar = $user->avatar ? route('user.get.avatar', $user->id) : asset('images/user.png');
//    return array('id' => $user->id, 'name' => $user->name, 'login' => $user->login, 'avatar' => $avatar);
//});
//Broadcast::channel('chat.{id}', function ($user) {
//    $avatar = $user->avatar ? route('user.get.avatar', $user->id) : asset('images/user.png');
//    return array('id' => $user->id, 'name' => $user->name, 'login' => $user->login, 'avatar' => $avatar);
//});