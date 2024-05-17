<?php

namespace App\Http\Controllers\DeliveryAgent\Order\Chat;

use App\Events\ChatSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ChatController extends Controller
{
    public function getUserMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiver' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $senderID = Auth::guard('deliveryAgent')->user()->id;
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
        $message->sender_id = Auth::guard('deliveryAgent')->user()->id;
        $message->receiver_id = $request->input('receiver');
        $message->is_sent_by_user = Auth::guard('deliveryAgent') ? false : true; // Check if the sender is a user or a delivery agent

        $message->save();

        // Broadcast the message using Pusher
        event(new ChatSent($message));

        return response()->json(['message' => 'Message sent successfully']);
    }

}
