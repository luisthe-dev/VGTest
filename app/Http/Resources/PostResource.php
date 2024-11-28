<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array(
            "id" => $this->id,
            "blog" => $this->blog,
            "title" => $this->post_title,
            "cover_image" => $this->post_cover_image,
            "content" => $this->post_content,
            "likes_count" => $this->likes()->count(),
            "comments_count" => $this->comments()->count(),
            "recent_comments" => CommentResource::collection($this->comments()->take(5))
        );
    }
}
