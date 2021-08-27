<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'season' => $this->season,
            'series' => $this->series,
            'premiere' => $this->premiere,
            'description' => $this->description,
            'image' => new ImageResource($this->image),
        ];
    }
}
