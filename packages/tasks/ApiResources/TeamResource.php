<?php

namespace Package\Tasks\ApiResources;

use Package\Tasks\ApiResources\MemberResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'name' => $this->name[app()->getLocale()] ?? $this->name['en'],
            'description' => $this->description[app()->getLocale()] ?? $this->description['en'],
            'members'=> $this->members,
        ];
    }
}