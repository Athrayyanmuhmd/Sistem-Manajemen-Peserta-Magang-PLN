<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UniversityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_name' => $this->short_name,
            'city' => $this->city,
            'province' => $this->province,
            'type' => $this->type,
            'accreditation' => $this->accreditation,
            'established_year' => $this->established_year,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'contact_person' => $this->contact_person,
            'contact_email' => $this->contact_email,
            'contact_phone' => $this->contact_phone,
            'website' => $this->website,
            'address' => $this->address,
            'partnership_start_date' => $this->partnership_start_date?->format('Y-m-d'),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            
            // Calculated fields
            'distance_from_office' => $this->when($this->latitude && $this->longitude, function () {
                return $this->calculateDistanceFromOffice() . ' km';
            }),
            
            'partnership_duration' => $this->when($this->partnership_start_date, function () {
                return $this->partnership_start_date->diffInYears(now()) . ' tahun';
            }),
            
            // Statistics when requested
            'statistics' => $this->when($request->get('include_stats'), function () {
                return $this->getComprehensiveStatistics();
            }),
            
            // Interns list when requested
            'interns' => $this->whenLoaded('interns', function () {
                return InternResource::collection($this->interns);
            }),
        ];
    }
}