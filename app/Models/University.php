<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'short_name',
        'city',
        'province',
        'type', // negeri, swasta, politeknik
        'accreditation',
        'established_year',
        'latitude',
        'longitude',
        'contact_person',
        'contact_email',
        'contact_phone',
        'website',
        'address',
        'partnership_start_date',
        'is_active'
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'established_year' => 'integer',
        'partnership_start_date' => 'date',
        'is_active' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    protected $dates = ['deleted_at', 'partnership_start_date'];

    protected $attributes = [
        'is_active' => true,
        'type' => 'negeri',
    ];

    // Constants
    public const TYPE_NEGERI = 'negeri';
    public const TYPE_SWASTA = 'swasta';
    public const TYPE_POLITEKNIK = 'politeknik';
    public const TYPE_INSTITUT = 'institut';

    public const TYPES = [
        self::TYPE_NEGERI => 'Negeri',
        self::TYPE_SWASTA => 'Swasta',
        self::TYPE_POLITEKNIK => 'Politeknik',
        self::TYPE_INSTITUT => 'Institut',
    ];

    public const ACCREDITATION_A = 'A';
    public const ACCREDITATION_B = 'B';
    public const ACCREDITATION_C = 'C';
    public const ACCREDITATION_UNGGUL = 'Unggul';
    public const ACCREDITATION_BAIK_SEKALI = 'Baik Sekali';
    public const ACCREDITATION_BAIK = 'Baik';

    public const ACCREDITATIONS = [
        self::ACCREDITATION_UNGGUL => 'Unggul',
        self::ACCREDITATION_A => 'A',
        self::ACCREDITATION_BAIK_SEKALI => 'Baik Sekali',
        self::ACCREDITATION_B => 'B',
        self::ACCREDITATION_BAIK => 'Baik',
        self::ACCREDITATION_C => 'C',
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

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByProvince($query, $province)
    {
        return $query->where('province', $province);
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeWithPartnership($query)
    {
        return $query->whereNotNull('partnership_start_date');
    }

    // Accessors & Mutators
    public function getFullNameAttribute(): string
    {
        return $this->short_name ? "{$this->short_name} - {$this->name}" : $this->name;
    }

    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([$this->address, $this->city, $this->province]);
        return implode(', ', $parts);
    }

    public function getPartnershipDurationAttribute(): ?int
    {
        if (!$this->partnership_start_date) return null;
        return now()->diffInYears($this->partnership_start_date);
    }

    public function getTypeDisplayAttribute(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function getAccreditationDisplayAttribute(): string
    {
        return self::ACCREDITATIONS[$this->accreditation] ?? $this->accreditation ?? 'Tidak Ada';
    }

    // Validation Rules
    public static function rules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:50',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'type' => 'required|in:' . implode(',', array_keys(self::TYPES)),
            'accreditation' => 'nullable|in:' . implode(',', array_keys(self::ACCREDITATIONS)),
            'established_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20|regex:/^[\d\s\-\+\(\)]+$/',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:500',
            'partnership_start_date' => 'nullable|date|before_or_equal:today',
            'is_active' => 'boolean',
        ];
    }

    // Methods
    public function getStatistics(): array
    {
        return [
            'total_interns' => $this->interns()->count(),
            'active_interns' => $this->activeInterns()->count(),
            'pending_interns' => $this->pendingInterns()->count(),
            'completed_interns' => $this->completedInterns()->count(),
            'completion_rate' => $this->getCompletionRate(),
            'partnership_duration' => $this->partnership_duration,
            'average_satisfaction' => $this->getAverageSatisfaction(),
        ];
    }

    public function getCompletionRate(): float
    {
        $totalFinished = $this->interns()->whereIn('status', [Intern::STATUS_COMPLETED, Intern::STATUS_TERMINATED])->count();
        $totalInterns = $this->interns()->count();
        
        if ($totalInterns === 0) return 0;
        
        $completed = $this->completedInterns()->count();
        return ($completed / $totalFinished) * 100;
    }

    public function getAverageSatisfaction(): float
    {
        return $this->interns()
                   ->whereNotNull('satisfaction_score')
                   ->avg('satisfaction_score') ?? 0;
    }

    public function getTopMajors(): array
    {
        return $this->interns()
                   ->selectRaw('major, COUNT(*) as count')
                   ->groupBy('major')
                   ->orderByDesc('count')
                   ->limit(5)
                   ->pluck('count', 'major')
                   ->toArray();
    }

    public function hasCoordinates(): bool
    {
        return !is_null($this->latitude) && !is_null($this->longitude);
    }

    public function getDistanceFromPLN($plnLat = 5.548, $plnLon = 95.324): ?float
    {
        if (!$this->hasCoordinates()) return null;

        $earthRadius = 6371; // km
        
        $latDelta = deg2rad($this->latitude - $plnLat);
        $lonDelta = deg2rad($this->longitude - $plnLon);
        
        $a = sin($latDelta/2) * sin($latDelta/2) +
             cos(deg2rad($plnLat)) * cos(deg2rad($this->latitude)) *
             sin($lonDelta/2) * sin($lonDelta/2);
             
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        
        return $earthRadius * $c;
    }
}
