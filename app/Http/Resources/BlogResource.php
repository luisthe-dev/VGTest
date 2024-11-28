<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            "title" => $this->blog_name,
            "recent_posts" => PostResource::collection($this->posts->take(5))
        );
    }
}
