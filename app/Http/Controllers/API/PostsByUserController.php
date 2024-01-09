<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsByUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $user_id)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $user_id)
    {
        try {

            $posts = Post::where('user_id',$user_id)->get();
            return response()->json($posts,200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in PostsByUserController.index',
                'error' =>$e->getMessage()
            ],400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
