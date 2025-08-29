<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\AuditableTrait;
use Carbon\Carbon;

class Intern extends Model
{
    use HasFactory, SoftDeletes, AuditableTrait;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp',
        'whatsapp_number',
        'nim',
        'university_id',
        'major',
        'student_id',
        'semester',
        'gpa',
        'birth_date',
        'department_id',
        'division_id',
        'supervisor',
        'start_date',
        'end_date',
        'duration_months',
        'status',
        'photo',
        'address',
        'emergency_contact',
        'emergency_phone',
        'notes',
        'nametag',
        'completion_percentage',
        'satisfaction_score',
        'skills_gained',
        'project_assigned',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'birth_date' => 'date',
        'gpa' => 'decimal:2',
        'completion_percentage' => 'integer',
        'satisfaction_score' => 'decimal:1',
        'skills_gained' => 'array',
        'project_assigned' => 'array',
        'is_active' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    protected $attributes = [
        'status' => 'pending',
        'completion_percentage' => 0,
    ];

    // Constants for status values
    public const STATUS_PENDING = 'pending';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_TERMINATED = 'terminated';
    public const STATUS_SUSPENDED = 'suspended';

    public const STATUSES = [
        self::STATUS_PENDING => 'Menunggu',
        self::STATUS_ACTIVE => 'Aktif',
        self::STATUS_COMPLETED => 'Selesai',
        self::STATUS_TERMINATED => 'Diberhentikan',
        self::STATUS_SUSPENDED => 'Diskors',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeByDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    public function scopeByUniversity($query, $universityId)
    {
        return $query->where('university_id', $universityId);
    }

    public function scopeByDivision($query, $divisionId)
    {
        return $query->where('division_id', $divisionId);
    }

    public function scopeEndingSoon($query, $days = 14)
    {
        return $query->where('status', self::STATUS_ACTIVE)
                    ->where('end_date', '>=', now())
                    ->where('end_date', '<=', now()->addDays($days));
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', self::STATUS_ACTIVE)
                    ->where('end_date', '<', now());
    }

    public function scopeStartingSoon($query, $days = 7)
    {
        return $query->where('status', self::STATUS_PENDING)
                    ->where('start_date', '>=', now())
                    ->where('start_date', '<=', now()->addDays($days));
    }

    // Validations
    public static function rules($id = null)
    {
        $baseRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:interns,email' . ($id ? ",{$id}" : ''),
            'phone' => 'nullable|string|max:20|regex:/^[\d\s\-\+\(\)]+$/',
            'university_id' => 'required|exists:universities,id',
            'major' => 'required|string|max:255',
            'student_id' => 'required|string|max:50|unique:interns,student_id' . ($id ? ",{$id}" : ''),
            'department_id' => 'required|exists:departments,id',
            'division_id' => 'required|exists:divisions,id',
            'supervisor' => 'nullable|string|max:255',
            'start_date' => $id ? 'required|date' : 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:' . implode(',', array_keys(self::STATUSES)),
            'address' => 'nullable|string|max:500',
            'emergency_contact' => 'nullable|string|max:255',
            'emergency_phone' => 'nullable|string|max:20|regex:/^[\d\s\-\+\(\)]+$/',
            'notes' => 'nullable|string|max:1000',
            'completion_percentage' => 'nullable|integer|min:0|max:100',
            'satisfaction_score' => 'nullable|numeric|min:1|max:5',
            'skills_gained' => 'nullable|array',
            'project_assigned' => 'nullable|array',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Additional optional fields for extended forms
        $extendedRules = [
            'whatsapp_number' => 'nullable|string|max:20|regex:/^[\d\s\-\+\(\)]+$/',
            'semester' => 'nullable|integer|min:1|max:14',
            'gpa' => 'nullable|numeric|min:0|max:4',
            'birth_date' => 'nullable|date|before:today',
            'is_active' => 'nullable|boolean',
        ];

        return $baseRules + $extendedRules;
    }

    public function getDurationAttribute(): string
    {
        if (!$this->start_date || !$this->end_date) {
            return 'Not set';
        }
        
        $duration = $this->start_date->diffInDays($this->end_date);
        return $duration . ' hari';
    }

    public function getRemainingDaysAttribute(): ?int
    {
        if (!$this->end_date || $this->status !== 'active') {
            return null;
        }
        
        $today = Carbon::today();
        if ($this->end_date->isPast()) {
            return 0;
        }
        
        return $today->diffInDays($this->end_date);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active' => 'bg-green-100 text-green-800',
            'completed' => 'bg-blue-100 text-blue-800',
            'terminated' => 'bg-red-100 text-red-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function calculateRealTimeProgress(): int
    {
        if (!$this->start_date || !$this->end_date || $this->status !== 'active') {
            return $this->completion_percentage ?? 0;
        }

        $today = Carbon::today();
        
        // Jika belum mulai
        if ($today->isBefore($this->start_date)) {
            return 0;
        }
        
        // Jika sudah selesai atau melewati tanggal akhir
        if ($today->isAfter($this->end_date) || $this->status === 'completed') {
            return 100;
        }
        
        // Hitung progress berdasarkan hari yang sudah berjalan
        $totalDays = $this->start_date->diffInDays($this->end_date);
        $daysPassed = $this->start_date->diffInDays($today);
        
        if ($totalDays <= 0) {
            return 100;
        }
        
        $progress = min(100, max(0, round(($daysPassed / $totalDays) * 100)));
        
        return $progress;
    }

    public function updateProgressAutomatically(): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        $newProgress = $this->calculateRealTimeProgress();
        $oldProgress = $this->completion_percentage;
        
        // Update hanya jika ada perubahan
        if ($newProgress !== $oldProgress) {
            $this->update(['completion_percentage' => $newProgress]);
            
            // Auto update status jika sudah 100% dan melewati tanggal akhir
            if ($newProgress >= 100 && Carbon::today()->isAfter($this->end_date)) {
                $this->update(['status' => 'completed']);
            }
            
            return true;
        }
        
        return false;
    }

    public function getProgressStatusAttribute(): array
    {
        $progress = $this->calculateRealTimeProgress();
        $today = Carbon::today();
        
        if (!$this->start_date || !$this->end_date) {
            return [
                'percentage' => $progress,
                'status' => 'no-dates',
                'message' => 'Tanggal belum diset',
                'color' => 'gray'
            ];
        }
        
        if ($today->isBefore($this->start_date)) {
            $daysUntilStart = $today->diffInDays($this->start_date);
            return [
                'percentage' => 0,
                'status' => 'pending-start',
                'message' => "Mulai dalam {$daysUntilStart} hari",
                'color' => 'blue'
            ];
        }
        
        if ($this->status === 'completed') {
            return [
                'percentage' => 100,
                'status' => 'completed',
                'message' => 'Selesai',
                'color' => 'green'
            ];
        }
        
        if ($today->isAfter($this->end_date)) {
            return [
                'percentage' => 100,
                'status' => 'overdue',
                'message' => 'Melewati batas waktu',
                'color' => 'red'
            ];
        }
        
        $remainingDays = $today->diffInDays($this->end_date);
        
        if ($progress >= 90) {
            return [
                'percentage' => $progress,
                'status' => 'almost-done',
                'message' => "Hampir selesai ({$remainingDays} hari lagi)",
                'color' => 'green'
            ];
        } elseif ($progress >= 50) {
            return [
                'percentage' => $progress,
                'status' => 'on-track',
                'message' => "Berjalan normal ({$remainingDays} hari lagi)",
                'color' => 'blue'
            ];
        } elseif ($remainingDays <= 7 && $progress < 80) {
            return [
                'percentage' => $progress,
                'status' => 'at-risk',
                'message' => "Perlu perhatian ({$remainingDays} hari lagi)",
                'color' => 'yellow'
            ];
        } else {
            return [
                'percentage' => $progress,
                'status' => 'in-progress',
                'message' => "Sedang berjalan ({$remainingDays} hari lagi)",
                'color' => 'blue'
            ];
        }
    }
}
