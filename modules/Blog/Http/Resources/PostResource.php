<?php

namespace Modules\Blog\Http\Resources;

use App\Http\Resources\BaseResource;
use App\Http\Resources\UserResource;

class PostResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'user' => UserResource::make($this->whenLoaded('user')),
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
