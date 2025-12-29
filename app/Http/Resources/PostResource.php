<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'slug'         => $this->slug,
            'content'      => $this->content,
            'status'       => $this->status,
            'thumbnail'    => $this->thumbnail 
                                ? asset('storage/' . $this->thumbnail) 
                                : null,

            'category' => [
                'id'   => $this->category->id ?? null,
                'name' => $this->category->name ?? null,
            ],

            'author' => [
                'id'   => $this->user->id ?? null,
                'name' => $this->user->name ?? null,
            ],

            'tags' => $this->tags->map(fn ($tag) => [
                'id'   => $tag->id,
                'name' => $tag->name,
            ]),

            'published_at' => optional($this->published_at)->toDateTimeString(),
            'created_at'   => $this->created_at->toDateTimeString(),
        ];
    }
}
