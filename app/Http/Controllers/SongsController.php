<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Models\Notification;
use App\Models\Song;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SongsController extends Controller
{
    public function index()
    {

        $songs = QueryBuilder::for(Song::class)
            ->allowedIncludes(['playlist', 'artist'])
            ->allowedSorts(['name', 'id'])
            ->jsonPaginate();
        return SongResource::collection($songs);
    }

    public function show(Song $song)
    {

        $song = QueryBuilder::for(Song::where('id', $song->id))
            ->allowedIncludes(['playlist', 'artist'])
            ->firstOrFail();
        return new SongResource($song);
    }

    public function store(Request $request)
    {
        // echo $request->input;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $uploadedFileSoundUrl = Cloudinary::uploadVideo($request->file('audio')->getRealPath())->getSecurePath();

            $uploadedFileImageUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $song = Song::create([
                'name' => $request->name,
                'liked' => 0,
                'artist_id' => $request->artist_id,
                'views' => 0,
                'imageURL' => $uploadedFileImageUrl,
                'audioURL' => $uploadedFileSoundUrl,
                'playlist_id' => $request->playlist_id
            ]);

            $users_id = DB::table('followed_artists')
                ->where('followed_artists.artist_id', '=', $request->artist_id)
                ->select('followed_artists.user_id')
                ->get();
            Log::info($users_id);

            foreach ($users_id as $p) {
                $notification = Notification::create([
                    'content' => $song->artist->name . ' đã thêm bài hát mới',
                    'user_id' => $p->user_id,
                    'bg_url' => $uploadedFileImageUrl,
                    'song_id' => $song->id
                ]);
                Log::info($notification);
            }
            return new SongResource($song);
        }

        return response(null, 502);
    }

    public function update(Request $request, Song $song)
    {
        $song->update($request->input('data.attributes'));
        return new SongResource($song);
    }

    public function delete(Song $song)
    {
        $song->delete();
        return response(null, 204);
    }

    public function uploadSong(Request $request)
    {
        $song = Song::create($request->input(("data.attributes")));
        return new SongResource($song);
    }
}
