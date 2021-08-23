<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'type' => $this->type,
            'dimension' => $this->dimension,
            'name' => $this->name,
            'description' => $this->description,
            'image' => new ImageResource($this->image),
        ];
    }
}
