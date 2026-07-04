<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CompletedBuildingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $attributes = collect($this->buildingModel->attributes);

        return [
            'id' => $this->id,
            'feature_id' => $this->feature_id,
            'feature_properties_id' => Str::upper($this->feature->properties->id),
            'building_total_area' => $attributes->firstWhere('slug', 'area')['value'] ?? null,
            'density' => $attributes->firstWhere('slug', 'density')['value'] ?? null,
        ];
    }
}
