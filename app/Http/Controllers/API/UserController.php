<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(int $id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json(['user' =>$user],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in UserController.show',
                'error' => $e->getMessage()
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
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            if($request->hasFile('image')){

                (New ImageService)->updateImage($user, $request, '/images/users/', 'update');
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->location = $request->location;
            $user->description = $request->description;

            $user->save();
            
            return response()->json('User Details Updated',200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in UserController.update',
                'error' => $e->getMessage()
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
