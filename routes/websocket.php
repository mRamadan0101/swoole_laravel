<?php


use Illuminate\Http\Request;
use App\Http\Controllers\ColorController;
use SwooleTW\Http\Websocket\Facades\Websocket;

/*
|--------------------------------------------------------------------------
| Websocket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register websocket events for your application.
|
*/

Websocket::on('connect', function ($websocket, $request) {
    // in connect callback, illuminate request will be injected here
    // echo "NEWWWWWWWWWWWWWWWWWWWWWWWW CONNECTION";
    // echo var_dump($request->user()->name);
    // dd($request);
    echo var_dump(auth()->user()) ;
    // Websocket::loginUsing($request->user());
    // $message = 'we have new user '.Websocket::getUserId();
    // echo $message;
    // $websocket->emit('websocketmessage', 'Welcome You Are connected');
});
// Websocket::on('sendingmsg', function ($websocket, $request) {
//     var_dump($request);
// });
Websocket::on('disconnect', function ($websocket) {
    // this callback will be triggered when a websocket is disconnected
});

Websocket::on('example', function ($websocket, $data) {
    $websocket->emit('message', $data);
});

Websocket::on('sendingmsg', 'App\Http\Controllers\ColorController@sendingmsg');
