<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Http\Requests\SendMessageRequest;
use App\Models\Message;
use Illuminate\View\View;


class MessageController extends Controller
{
    private const USERS = ['User 1', 'User 2'];

    public function index(): View
    {
        return view('chats', [
            'messages' => Message::all(),
            'chats' => [
                [
                    'sender' => self::USERS[0],
                    'receiver' => self::USERS[1]
                ],
                [
                    'sender' => self::USERS[1],
                    'receiver' => self::USERS[0]
                ],
            ]
        ]);
    }

    public function sendMessage(SendMessageRequest $request): void
    {
        event(new MessageCreated(Message::create($request->validated())));
    }
}
