<?php

namespace App\Http\Resources;

use App\Traits\JsonResourceCustomization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class UserResource extends JsonResource
{
    use JsonResourceCustomization ;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                "notices" => NoticeResource::collection($this->whenLoaded("notices")),
                'created_at' => $this->created_at->getTimestamp(),
                'updated_at' => $this->updated_at->getTimestamp(),
            ]
        ];
    }
}
