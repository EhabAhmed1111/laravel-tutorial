<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::all();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // $data = $request->all();
        //this used to show some of the req not all 
        // but all request will be processed
        // $data = $request->only('id', 'title');
        $data = $request->validated();
        $data['author_id'] = 1;
        $post = Post::create($data);

        return response()->json($post,201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //this either return the post or give 404 status code
        // $data = Post::findOrFail($id);
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // the two way to validate req
        // 200 code or unprocessable req 422
        $data = $request->validate([
            'title'=>'required|string|min:2',
            'body'=>['required', 'string', 'min:2']
        ]);

        $post->update($data);

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // this send 204 status code for no content
        // $post = findOrFail($id);
        $post->delete();
        return response()->noContent();
    }
}
