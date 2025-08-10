<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'location' => $this->location,
            'capacity' => $this->capacity,
            'current_interns_count' => $this->current_interns_count,
            'utilization_percentage' => $this->utilization_percentage,
            'can_accept_more' => $this->canAcceptMoreInterns(),
            'contact_person' => $this->contact_person,
            'contact_email' => $this->contact_email,
            'contact_phone' => $this->contact_phone,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            
            // Statistics when requested
            'statistics' => $this->when($request->get('include_stats'), function () {
                return $this->getStatistics();
            }),
            
            // Interns list when requested
            'interns' => $this->whenLoaded('interns', function () {
                return InternResource::collection($this->interns);
            }),
        ];
    }
}