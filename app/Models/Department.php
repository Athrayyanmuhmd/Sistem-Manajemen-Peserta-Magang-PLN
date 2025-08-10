<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\AuditableTrait;

class Department extends Model
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'name',
        'code',
        'description',
        'head_of_department',
        'contact_email',
        'contact_phone',
        'location',
        'capacity',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'capacity' => 'integer',
        'deleted_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    protected $attributes = [
        'is_active' => true,
        'capacity' => 10,
    ];

    // Relations
    public function interns(): HasMany
    {
        return $this->hasMany(Intern::class);
    }

    public function activeInterns(): HasMany
    {
        return $this->hasMany(Intern::class)->where('status', Intern::STATUS_ACTIVE);
    }

    public function pendingInterns(): HasMany
    {
        return $this->hasMany(Intern::class)->where('status', Intern::STATUS_PENDING);
    }

    public function completedInterns(): HasMany
    {
        return $this->hasMany(Intern::class)->where('status', Intern::STATUS_COMPLETED);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithCapacity($query)
    {
        return $query->where('capacity', '>', 0);
    }

    public function scopeAvailable($query)
    {
        return $query->whereHas('activeInterns', function($q) {
            $q->havingRaw('COUNT(*) < departments.capacity');
        });
    }

    // Accessors & Mutators
    public function getUtilizationPercentageAttribute(): float
    {
        if (!$this->capacity || $this->capacity <= 0) return 0;
        
        $activeCount = $this->activeInterns()->count();
        return min(100, ($activeCount / $this->capacity) * 100);
    }

    public function getAvailableSlotsAttribute(): int
    {
        $activeCount = $this->activeInterns()->count();
        return max(0, ($this->capacity ?? 0) - $activeCount);
    }

    public function getIsFullAttribute(): bool
    {
        return $this->available_slots <= 0;
    }

    public function getFullNameAttribute(): string
    {
        return $this->code ? "{$this->code} - {$this->name}" : $this->name;
    }

    // Validation Rules
    public static function rules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:10|unique:departments,code' . ($id ? ",{$id}" : ''),
            'description' => 'nullable|string|max:1000',
            'head_of_department' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20|regex:/^[\d\s\-\+\(\)]+$/',
            'location' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1|max:1000',
            'is_active' => 'boolean',
        ];
    }

    // Methods
    public function canAcceptMoreInterns(): bool
    {
        return $this->is_active && !$this->is_full;
    }

    public function getStatistics(): array
    {
        return [
            'total_interns' => $this->interns()->count(),
            'active_interns' => $this->activeInterns()->count(),
            'pending_interns' => $this->pendingInterns()->count(),
            'completed_interns' => $this->completedInterns()->count(),
            'capacity' => $this->capacity,
            'utilization_percentage' => $this->utilization_percentage,
            'available_slots' => $this->available_slots,
        ];
    }
}
