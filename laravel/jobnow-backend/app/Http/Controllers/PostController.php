<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\File;
use App\Models\Like;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')->get();

        return response($posts);
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
            'title' => 'required|max:20',
            'description' => 'required|max:255',
            'author_id' => 'required',
            'image_id' => 'required|mimes:jpg,jpeg'
        ]);

        $input = $request->all();

        $upload = $request->file('image_id');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        $fileExtension = $upload->getClientOriginalExtension();
        $uploadName = time() . '_' . $fileName;

        $filePath = $upload->storeAs(
            'uploads',
            $uploadName,
            'public'
        );
        
        if(\Storage::disk('public')->exists($filePath)) {

            $fullPath = \Storage::disk('public')->path($filePath);

            $file = File::create([
                'filename' => $filePath,
                'filesize' => $fileSize,
            ]);

            $upload->filepath = $filePath;
            $upload->filesize = $fileSize;
            $input['image_id'] = $file->id;
        }

        $post = Post::create($input);

        return \response("Post created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $post = Post::find($id);

        return response($post);
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
        $post = Post::find($id)
        ->update($request->all());

        return response($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $file = File::where('id', $post->image_id)->first();
        $like = Like::where('post_id', $post->id)->delete();

        $post->delete();
        $file->delete();
        
        Storage::disk('public')->delete($file->filepath);

        return \response("Success. The post ${post->id} has been eliminated");
    }
}