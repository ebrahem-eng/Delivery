<?php

namespace App\Http\Controllers\User\Order\Chat;

use App\Events\ChatSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\UserD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ChatController extends Controller
{
    //

    public function showChatPage($id)
    {
        $user = UserD::findOrfail($id);
          $receiver = $user->id;

          return view('User/Chat/chat' , compact('receiver'));
    }

    // public function sendMessage(Request $request)
    // {
 
    //     $validator = Validator::make($request->all(), [
    //         // 'sender' => 'required',
    //         'receiver' => 'required',
    //         'message' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     // Create a new message
    //     $message = new Message();
    //     $message->sender = Auth::guard('userD')->user()->id;
    //     $message->receiver = $request->input('receiver');
    //     $message->message = $request->input('message');
    //     $message->save();

    //     // Trigger event to broadcast the message
    //     event(new ChatSent($message));

    //     return response()->json(['message' => 'Message sent successfully'], 201);
    // }

    public function getUserMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiver' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $senderID = Auth::guard('userD')->user()->id;
        $receiver = $request->input('receiver');
    
        $messages = Message::where('sender_id', $senderID)
                            ->where('receiver_id', $receiver)
                            ->get();
    
        $messageData = [];
        foreach ($messages as $message) {
            $isSentByCurrentUser = $message->is_sent_by_user == 1 ? true : false;
    
            $messageData[] = [
                'content' => $message->content,
                'isSentByCurrentUser' => $isSentByCurrentUser,
            ];
        }
    
        return response()->json(['message' => $messageData]);
    }
    


    public function sendMessage(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'receiver' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $message = new Message();
        $message->content = $request->input('content');
        $message->sender_id = Auth::guard('userD')->user()->id;
        $message->receiver_id = $request->input('receiver');
        $message->is_sent_by_user = Auth::guard('userD') ? true : false; // Check if the sender is a user or a delivery agent

        $message->save();

        // Broadcast the message using Pusher
        event(new ChatSent($message));

        return response()->json(['message' => 'Message sent successfully']);
    }


}
