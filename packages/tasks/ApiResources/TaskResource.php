<?php

namespace Package\Tasks\ApiResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Package\Tasks\ApiResources\TeamResource;
use Package\Tasks\ApiResources\MemberResource;
use Package\Tasks\ApiResources\ProirityResource;
class TaskResource extends JsonResource
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
            'title'=>$this->title,
            'description'=>$this->description,
            'statue'=>$this->statue,
            'proirity'=>new ProirityResource($this->proirity),
            'team'=>new TeamResource($this->team),
            'member'=>new MemberResource($this->member),
        ];
    }
}
