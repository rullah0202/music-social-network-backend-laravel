<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Song\StoreSongRequest;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class SongController extends Controller
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
    public function store(StoreSongRequest $request)
    {
        try {

            $file = $request->file;

            if(empty($file)){
                return response()->json('No Song Uploaded',400);
            }

            $user = User::findOrFail($request->get('user_id'));
            $song = $file->getClientOriginalName();
            $file->move('songs/' . $user->id, $song);

            Song::create([
                'user_id' => $request->get('user_id'),
                'title' => $request->get('title'),
                'song' => $song,
            ]);

            return response()->json('Song Saved!',200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in SongController.store',
                'error' =>$e->getMessage()
            ],400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, int $user_id)
    {
        try {
            $song = Song::findOrFail($id);

            $currentSong = public_path() . "/songs/" . $user_id . "/" . $song->song;

            if(fileExists($currentSong)){
                unlink($currentSong);
            }

            $song->delete();

            return response()->json('Song Deleted',200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in SongController.destroy',
                'error' =>$e->getMessage()
            ],400);
        }
    }
}
