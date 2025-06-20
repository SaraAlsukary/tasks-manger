<?php

namespace Package\Tasks\ApiResources;

use Illuminate\Http\Request;
use Package\Tasks\ApiResources\TeamResource;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            "teams"=>$this->teams

        ];
    }
}
