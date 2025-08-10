<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InternResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'whatsapp_number' => $this->whatsapp_number,
            'student_id' => $this->student_id,
            'major' => $this->major,
            'semester' => $this->semester,
            'gpa' => $this->gpa,
            'birth_date' => $this->birth_date?->format('Y-m-d'),
            'address' => $this->address,
            'status' => $this->status,
            'status_label' => $this->status_label,
            'start_date' => $this->start_date?->format('Y-m-d'),
            'end_date' => $this->end_date?->format('Y-m-d'),
            'duration_days' => $this->duration_days,
            'progress_percentage' => $this->progress_percentage,
            'photo' => $this->photo ? asset('storage/' . $this->photo) : null,
            'notes' => $this->notes,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            
            // Relationships
            'department' => $this->whenLoaded('department', function () {
                return [
                    'id' => $this->department->id,
                    'name' => $this->department->name,
                    'code' => $this->department->code,
                    'location' => $this->department->location,
                ];
            }),
            
            'university' => $this->whenLoaded('university', function () {
                return [
                    'id' => $this->university->id,
                    'name' => $this->university->name,
                    'short_name' => $this->university->short_name,
                    'city' => $this->university->city,
                    'province' => $this->university->province,
                    'type' => $this->university->type,
                ];
            }),
            
            'division' => $this->whenLoaded('division', function () {
                return [
                    'id' => $this->division->id,
                    'name' => $this->division->name,
                    'code' => $this->division->code,
                    'location' => $this->division->location,
                ];
            }),
            
            // Progress Information
            'progress_status' => $this->when($request->routeIs('interns.show') || $request->get('include_progress'), function () {
                return $this->progress_status;
            }),
        ];
    }
}