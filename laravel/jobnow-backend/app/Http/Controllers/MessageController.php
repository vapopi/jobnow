<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Models\Notification;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = DB::table('messages')
        ->select('id', 'message', 'author_id', 'receiver_id', 'created_at')
        ->get();

        return response($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|max:255',
            'author_id' => 'required',
            'receiver_id' => 'required'
        ]);



        $message = Message::create($request->all());

        Notification::create([
            'title' => "New messages",
            'description' => "Seems that you received new messages in chatapp, check it!",
            'author_id' => $request['receiver_id'],
        ]);

        return response($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $message = Messages::find($id);

        return response($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $message = Message::find($id)
        ->update($request->all());

        return response($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Message::destroy($id);

        return \response("Success. The message ${id} has been eliminated");
    }
}