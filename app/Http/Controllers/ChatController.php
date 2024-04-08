<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Chat;

use App\Models\Page;
use App\Models\User;
use App\Traits\SendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    use SendNotification;
    public function index()
    {
        if (Session::has('LoggedIn')) {

            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['users'] = User::all()->except(Session::get('LoggedIn'));

            $data['title'] = 'Chat';
            $data['pages'] = Page::all();

            $data['navChatActiveClass'] = "active";
            return view('chat', $data);
        }
    }

    public function getChatMessages(Request $request)
{
    $receiverId = $request->receiver_id;
    $senderId = $request->sender_id;

    $messages = Chat::select('chats.*', 'sender.name as sender_name', 'sender.profile_photo as sender_photo', 'receiver.name as receiver_name', 'receiver.profile_photo as receiver_photo')
    ->join('users as sender', 'chats.sender_id', '=', 'sender.id')
    ->join('users as receiver', 'chats.receiver_id', '=', 'receiver.id')
    ->where(function ($query) use ($senderId, $receiverId) {
        $query->where('sender_id', $senderId)
              ->where('receiver_id', $receiverId);
    })->orWhere(function ($query) use ($senderId, $receiverId) {
        $query->where('sender_id', $receiverId)
              ->where('receiver_id', $senderId);
    })->get();

    // Return messages in the response
    return response()->json(['messages' => $messages]);
}

    public function sendChatMessage(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'message' => 'required',
        ]);

        // Create a new chat message
        $chat = new Chat();
        $chat->sender_id = $validatedData['sender_id'];
        $chat->receiver_id = $validatedData['receiver_id'];
        $chat->message = $validatedData['message'];
        $chat->save();
        $text = $validatedData['message'];
        $target_url = url('chat');
        event(new ChatEvent($text));
        $this->sendForApi($text, 2, $target_url, $validatedData['sender_id'], $validatedData['sender_id']);
        return response()->json(['success' => 'Message sent successfully!']);
    }
}
