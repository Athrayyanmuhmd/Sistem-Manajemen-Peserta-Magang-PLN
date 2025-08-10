<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'head_of_division',
        'contact_email',
        'contact_phone',
        'capacity',
        'location',
        'budget',
        'is_active'
    ];

    protected $casts = [
        'capacity' => 'integer',
        'budget' => 'decimal:2',
        'is_active' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    protected $attributes = [
        'is_active' => true,
        'capacity' => 15,
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

    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
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

    public function getUtilizationStatusAttribute(): string
    {
        $percentage = $this->utilization_percentage;
        
        if ($percentage >= 90) return 'critical';
        if ($percentage >= 75) return 'high';
        if ($percentage >= 50) return 'medium';
        if ($percentage >= 25) return 'low';
        return 'minimal';
    }

    // Validation Rules
    public static function rules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:divisions,code' . ($id ? ",{$id}" : ''),
            'description' => 'nullable|string|max:1000',
            'head_of_division' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20|regex:/^[\d\s\-\+\(\)]+$/',
            'capacity' => 'required|integer|min:1|max:1000',
            'location' => 'nullable|string|max:255',
            'budget' => 'nullable|numeric|min:0|max:999999999.99',
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
            'utilization_status' => $this->utilization_status,
            'available_slots' => $this->available_slots,
            'budget' => $this->budget,
        ];
    }

    public function getFinancialImpact(): array
    {
        $activeInterns = $this->activeInterns()->count();
        $estimatedCostPerIntern = $this->budget ? ($this->budget / max($this->capacity, 1)) : 0;
        
        return [
            'budget_allocated' => $this->budget,
            'budget_utilized' => $activeInterns * $estimatedCostPerIntern,
            'budget_remaining' => max(0, ($this->budget ?? 0) - ($activeInterns * $estimatedCostPerIntern)),
            'cost_per_intern' => $estimatedCostPerIntern,
            'efficiency_ratio' => $this->capacity > 0 ? $activeInterns / $this->capacity : 0,
        ];
    }
}
