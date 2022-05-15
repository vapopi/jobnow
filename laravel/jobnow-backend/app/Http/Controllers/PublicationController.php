<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('publications.index', [
            "posts" => Post::all(),
            "users" => User::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $post = Post::all()->where('id', "=", $id)->first();
        $file = File::where('id', "=", $post->image_id)->first();

        return view('publications.show', [

            "post" => $post,
            "file" => $file,
            "users" => User::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
