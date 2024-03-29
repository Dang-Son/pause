<?php

namespace App\Http\Controllers;

use App\Models\notification;
use App\Http\Requests\StorenotificationRequest;
use App\Http\Requests\UpdatenotificationRequest;
use App\Http\Resources\NotificationResource;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = QueryBuilder::for(notification::class)
            ->allowedIncludes(['user', 'comment'])
            ->allowedSorts(['id'])
            ->jsonPaginate();
        return NotificationResource::collection($notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorenotificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorenotificationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $notifications = Notification::all()->where('user_id', '=', $user_id);
        return NotificationResource::collection($notifications);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatenotificationRequest  $request
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatenotificationRequest $request, notification $notification)
    {
        $notification->update(['link' => $request->input('link'), 'content' => $request->input('content')]);
        return $notification;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(notification $notification)
    {
        $notification->delete();
        return response(null, 204);
    }
}
