<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => (int) $this->id,
            'title'     => $this->title,
            'content'   => $this->content,
            'language'  => $this->language,
            'private'   => (bool) $this->private,
            'encrypted' => (bool) $this->encrypted,
            'author'    => new UserResource($this->whenLoaded('author')),
        ];
    }
}
