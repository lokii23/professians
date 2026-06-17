<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('messages.index', compact('users'));
    }

    public function show(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {

            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $user->id);

        })->orWhere(function ($query) use ($user) {

            $query->where('sender_id', $user->id)
                  ->where('receiver_id', Auth::id());

        })->orderBy('created_at')->get();

        return view('messages.chat', compact('user', 'messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'message' => 'required'
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return back();
    }
}