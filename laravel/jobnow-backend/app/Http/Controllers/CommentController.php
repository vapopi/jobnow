<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $tid)
    {
        $comments = Comment::where('ticket_id', '=', $tid)->get();

        return response($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $tid, Request $request)
    {
        $request->validate([
            'comment' => 'required|max:255',
            'author_id' => 'required'
        ]);

        $all = $request->all();
        $all['ticket_id'] = $tid;
        $comment = Comment::create($all);

        return response($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $tid, int $cid)
    {
        $comment = Comment::where('ticket_id', '=', $tid)
        ->find($cid);

        return response($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $tid, Request $request, int $cid)
    {
        $comment = Comment::where('ticket_id', '=', $tid)
        ->find($cid)
        ->update($request->all());

        return response($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $tid, int $cid)
    {
        Comment::where('ticket_id', '=', $tid);
        Comment::destroy($cid);

        // return response(content: "Success. The comment ${cid} has been eliminated");
    }
}