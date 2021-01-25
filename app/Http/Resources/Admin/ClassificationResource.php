<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'raceId' => $this->raceId,
            'raceType' => $this->type,
            'runnerId' => $this->runnerId,
            'runnerAge' => $this->runnerAge,
            'runnerName' => $this->runnerName,
            'runnerPosition' => $this->runnerPosition,
        ];
    }
}
