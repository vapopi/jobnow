<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat.index', [

            'messages' => Message::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Message::destroy($id);

        return \redirect()->route('chat.index')
        ->with('success', "The message number: {$id} has been eliminated");
    }
}