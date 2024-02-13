<?php

namespace App\Http\Controllers;

use App\Events\MessageSent as EventsMessageSent;
use Illuminate\Http\Request;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }
    public function index2()
    {
        return view('chat2');
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_CLUSTER'),
                'encrypted' => true
            ]
        );

        $response = $pusher->trigger('chatting-app', 'message-sent', ['message' => $message]);

 
        return response()->json(['status' => 'Message sent']);
    }
    
    public function sendMessage2(Request $request)
    {
        $message = $request->input('message');
        
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_CLUSTER'),
                'encrypted' => true
            ]
        );

        $response = $pusher->trigger('chatting-app', 'message-sent2', ['message' => $message]);

 
        return response()->json(['status' => 'Message sent']);
    }
}
