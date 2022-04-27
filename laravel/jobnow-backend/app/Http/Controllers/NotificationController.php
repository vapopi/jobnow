<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $author_id)
    {
        $notifications = Notification::where('author_id', '=', $author_id)->get();

        return response($notifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $author_id, Request $request)
    {
        $request->validate([
            'notification' => 'required|max:255',
            'author_id' => 'required'
        ]);

        $all = $request->all();
        $all['author_id'] = $author_id;
        $notification = Notification::create($all);

        return response($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, int $author_id)
    {
        $notification = Notification::where('author_id', '=', $author_id)
        ->find($id);

        return response($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, int $author_id)
    {
        Notification::where('author_id', '=', $author_id);
        Notification::destroy($id);

        return response(content: "Success. The notification ${id} has been eliminated");
    }
}
