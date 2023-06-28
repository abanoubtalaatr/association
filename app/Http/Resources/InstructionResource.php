<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->{"title_" . app()->getLocale()},
            'description' => $this->{"description_" . app()->getLocale()},
            'created_at' => $this->created_at,
            'media_type'=>"",
            'media' => "",
            'is_completed' => "",
        ];
    }
}
