<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use Whoops\Exception\Frame;
use Illuminate\Http\Request;
use SwooleTW\Http\Server\Facades\Server;
use SwooleTW\Http\Websocket\Facades\Websocket;
use SwooleTW\Http\Transformers\Request as SwooleRequest;

class ColorController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    public function getcolors(Request $request)
    {
        try {
            $colors = DB::table('color')->get();
            $response['colors'] = $colors;
        } catch (\Exception $e) {
            $statusCode = 200;
            $response["status"] = -3;
            $response['message'] = $e->getMessage();
        } finally {
            return response()->json($response, 200);
        }
    }
    public function login(Request $request)
    {
        try {
            $response=[];
            $statusCode = 200;
            $user = User::where('email', $request->email)->first();
            if ($user) {
                // var_dump(\Hash::check($request->password, $user->password));
                if (\Hash::check($request->password, $user->password)) {
                    Auth::loginUsingId(1);
                    // auth()->loginUsingId($user->id);
                    // $user->api_token = str_random($length = 60);
                    // $user->save();
                    // echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
                    // var_dump($user);
                    $response['status'] = 1;
                    $response['message'] ='aaaaaaaaaaaaaaa';
                    $response['user'] = $user;
                }
            }
        } catch (\Exception $e) {
            $statusCode = 200;
            $response["status"] = -3;
            $response['message'] = $e->getMessage();
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    public function sendingmsg($websocket, $request)
    {
        Websocket::toUserId($request['to'])->emit('websocketmessage', $request['message']);
    }
}
