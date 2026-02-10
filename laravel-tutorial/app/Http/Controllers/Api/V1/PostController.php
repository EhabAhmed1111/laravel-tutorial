<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            [
                'id'=>1,
            'title'=>'test',
            'body'=>'post body'
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        //this used to show some of the req not all 
        // but all request will be processed
$data = $request->only('id', 'title');
return response()->json([
    'message'=>'test',
    'data'=>[
    'id'=>$data['id'],
    'title'=>$data['title'],
    'body'=>'post body'
]],201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data'=>[
            'id'=>1,
            'title'=>'test',
            'body'=>'post body'
        ]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // the two way to validate req
        $data = $request->validate([
            'title'=>'required|string|min:2',
            'body'=>['required', 'string', 'min:2']
        ]);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->noContent();
    }
}
