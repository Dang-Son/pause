<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'notification',
            'attributes' => [
                'link' => $this->link,
                'content' => $this->content,
            ],

            'relationships' => [
                'user' => [
                    'links' => [],
                    'data' => [],
                ],
                'comment' => [
                    'links' => [],
                    'data' => CommentResource::collection($this->whenLoaded('comments')),
                ],
            ],
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ];
    }
}