<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FollowedArtistUserController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SongPlaylistRelatedController;
use App\Http\Controllers\SongPlaylistRelationshipsController;
use App\Http\Controllers\UserController;
use App\Http\Resources\AritistResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\HistoryResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\SongResource;
use App\Models\Artist;
use App\Models\History;
use App\Models\Song;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use PHPJuice\Slopeone\Algorithm;
use OpenCF\RecommenderService;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{user}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::patch('/user/{user}', [UserController::class, 'update']);
Route::delete('/user/{user}', [UserController::class, 'destroy']);

Route::get('/user/{user}/followed', [FollowedArtistUserController::class, 'show']);
Route::get('/artist/{artist}/followed', [FollowedArtistUserController::class, 'showListUserFollowArtist']);
Route::post('/user/{user}/{artist}/followed', [FollowedArtistUserController::class, 'follow']);
Route::delete('/user/{user}/{artist}/followed', [FollowedArtistUserController::class, 'unfollow']);


Route::get('/song', [SongsController::class, 'index']);
Route::get('/song/{song}', [SongsController::class, 'show']);
Route::post('/song', [SongsController::class, 'store']);
Route::patch('/song/{song}', [SongsController::class, 'update']);
Route::delete('/song/{song}', [SongsController::class, 'delete']);



Route::get('/artist', [ArtistController::class, 'index']);
Route::get('/artist/{artist}', [ArtistController::class, 'show']);
Route::post('/artist', [ArtistController::class, 'store']);
Route::patch('/artist/{artist}', [ArtistController::class, 'update']);
Route::delete('/artist/{artist}', [ArtistController::class, 'destroy']);


Route::get('/comment', [CommentController::class, 'index']);
Route::get('/comment/{comment}', [CommentController::class, 'show']);
Route::post('/comment', [CommentController::class, 'store']);
Route::patch('/comment/{comment}', [CommentController::class, 'update']);
Route::delete('/comment/{comment}', [CommentController::class, 'destroy']);


Route::get('/notification', [NotificationController::class, 'index']);
Route::get('/notification/{notification}', [NotificationController::class, 'show']);
Route::post('/notification', [NotificationController::class, 'store']);
Route::patch('/notification/{notification}', [NotificationController::class, 'update']);
Route::delete('/notification/{notification}', [NotificationController::class, 'destroy']);

// playlist
Route::get('/playlist', [PlaylistController::class, 'index']);
Route::patch('/playlist/{playlist}', [PlaylistController::class, 'update']);
Route::post('/playlist', [PlaylistController::class, 'store']);

// playlist
Route::get('/playlist/{playlist}', [PlaylistController::class, 'show']);

// get only relationship
Route::get('song/{song}/relationships/playlist',  [SongPlaylistRelationshipsController::class, 'index'])->name('song.relationships.playlist');

// update relationship
Route::patch('song/{song}/relationships/playlist',  [SongPlaylistRelationshipsController::class, 'update'])->name('song.relationships.playlist');


Route::get('/history', [HistoryController::class, 'index']);
Route::get('/history/{history}', [HistoryController::class, 'show']);
Route::post('/history/{user}/{song}', [HistoryController::class, 'store']);
Route::patch('/history/{history}', [HistoryController::class, 'update']);
Route::delete('/history/{history}', [HistoryController::class, 'destroy']);

Route::get('/history/user/{user}', [HistoryController::class, 'get_history_of_user']);



// Get total user 
Route::get('/user/total/{user}', [UserController::class, 'get_total']);


// related
Route::get('song/{song}/playlist', [SongPlaylistRelatedController::class, 'index'])->name('song.playlist');

// Route::get('/follow', [FollowController::class, 'index']);


//Search
Route::get('/search', [SearchController::class, 'index']);
Route::get('/search/category', [SearchController::class, 'getAllSongSameCategory']);

Route::get('/recommendation/{user}', [RecommendationController::class, 'get_songs']);


//register
Route::post('/register', [AuthController::class, 'register']);
//login
Route::post('/login', [AuthController::class, 'login']);

Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::get('/get_comment', [CommentController::class, 'get_comment']);

Route::post('/song/upload', [SongsController::class, 'uploadSong']);
