<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LatestPostResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d'),
            'num_of_views' => $this->num_of_views,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
                'staus' => $this->category->status,
            ],
//            'post_user' => [
//                'name' => $this->admin->name,
//                'email' => $this->admin->email,
//                'username' => $this->admin->username,
//                'status' => $this->admin->status,
//                'phone' => $this->admin->phone,
//                'image' => $this->admin->image ? asset('storage/' . $this->user->image) : null,
//            ],
        ];
    }
}
