<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'location' => $this->location,
            'budget' => $this->budget,
            'budget_formatted' => $this->budget ? 'Rp ' . number_format($this->budget, 0, ',', '.') : null,
            'head_of_division' => $this->head_of_division,
            'contact_email' => $this->contact_email,
            'contact_phone' => $this->contact_phone,
            'capacity' => $this->capacity,
            'current_interns_count' => $this->current_interns_count,
            'utilization_status' => $this->utilization_status,
            'can_accept_more' => $this->canAcceptMoreInterns(),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            
            // Financial Impact when requested
            'financial_impact' => $this->when($request->get('include_financial'), function () {
                return $this->calculateFinancialImpact();
            }),
            
            // Interns list when requested
            'interns' => $this->whenLoaded('interns', function () {
                return InternResource::collection($this->interns);
            }),
        ];
    }
}