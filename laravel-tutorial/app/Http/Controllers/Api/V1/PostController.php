<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        $posts = $user->posts()->paginate();
        // this will git all posts with its user
        // return PostResource::collection(Post::with('author')->paginate());
        return PostResource::collection($posts);
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
        $data['author_id'] = $request->user()->id;
        $post = Post::create($data);

        return response()->json(new PostResource($post),201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $user = request()->user();
        abort_if($user->id != $post->author_id, 403, "Access Forbiden");

        //this either return the post or give 404 status code
        // $data = Post::findOrFail($id);
        // if I remove response()->json() and return it normally 
        // laravel will transform it to json automatically and will wrap it with data object and it some times really good to use
        // and also set status code to the correct code
        return response()->json(new PostResource($post));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $user = request()->user();
        abort_if($user->id != $post->author_id, 403, "Access Forbiden");
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
        $user = request()->user();
        abort_if($user->id != $post->author_id, 403, "Access Forbiden");
        // this send 204 status code for no content
        // $post = findOrFail($id);
        $post->delete();
        return response()->noContent();
    }
}
