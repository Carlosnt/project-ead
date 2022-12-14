<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class LessonResource extends JsonResource
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
            'name' => ucwords(strtolower($this->name)),
            'description' => $this->description,
            'embed' => $this->embed,
            'duration' => $this->duration,
            'url' => $this->url,
            'views' => ViewResource::collection($this->whenLoaded('views')),
        ];
    }
}
