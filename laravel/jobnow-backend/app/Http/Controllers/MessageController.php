<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $gid)
    {
        $messages = Message::where('group_id', '=', $gid)->get();

        return response($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $gid, Request $request)
    {
        $request->validate([
            'message' => 'required|max:255',
            'author_id' => 'required'
        ]);

        $all = $request->all();
        $all['group_id'] = $gid;
        $message = Message::create($all);

        return response($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $gid, int $mid)
    {
        $message = Messages::where('group_id', '=', $gid)
        ->find($mid);

        return response($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $gip, Request $request, int $mid)
    {
        $message = Message::where('group_id', '=', $gid)
        ->find($mid)
        ->update($request->all());

        return response($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $gid, int $mid)
    {
        Message::where('group_id', '=', $gid);
        Message::destroy($mid);

        return response(content: "Success. The message ${mid} has been eliminated");
    }
}