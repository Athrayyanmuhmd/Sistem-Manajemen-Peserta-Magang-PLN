<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait AuditableTrait
{
    /**
     * Boot the auditable trait for a model.
     */
    public static function bootAuditableTrait()
    {
        static::created(function ($model) {
            $model->logAuditEvent('created', null, $model->getAttributes());
        });

        static::updated(function ($model) {
            $original = $model->getOriginal();
            $changes = $model->getChanges();
            
            if (!empty($changes)) {
                $model->logAuditEvent('updated', $original, $changes);
            }
        });

        static::deleted(function ($model) {
            $model->logAuditEvent('deleted', $model->getAttributes(), null);
        });

        if (method_exists(static::class, 'restored')) {
            static::restored(function ($model) {
                $model->logAuditEvent('restored', null, $model->getAttributes());
            });
        }
    }

    /**
     * Log audit event
     */
    protected function logAuditEvent(string $event, ?array $oldValues, ?array $newValues): void
    {
        $tableName = $this->getTable();
        $modelId = $this->getKey();
        $modelClass = get_class($this);
        $userId = Auth::id();
        $userEmail = Auth::check() ? Auth::user()->email : 'system';

        $auditData = [
            'event' => $event,
            'model' => $modelClass,
            'model_id' => $modelId,
            'table' => $tableName,
            'user_id' => $userId,
            'user_email' => $userEmail,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url' => request()->fullUrl(),
            'timestamp' => now()->toISOString(),
        ];

        if ($oldValues !== null) {
            $auditData['old_values'] = $this->filterSensitiveData($oldValues);
        }

        if ($newValues !== null) {
            $auditData['new_values'] = $this->filterSensitiveData($newValues);
        }

        // Log to Laravel log
        Log::channel('audit')->info("Model {$event}: {$modelClass}#{$modelId}", $auditData);

        // You can also store in database if needed
        $this->storeAuditLog($auditData);
    }

    /**
     * Filter sensitive data from audit logs
     */
    protected function filterSensitiveData(array $data): array
    {
        $sensitiveFields = [
            'password',
            'password_confirmation', 
            'remember_token',
            'api_token',
            'secret',
            'private_key',
            'access_token',
            'refresh_token'
        ];

        foreach ($sensitiveFields as $field) {
            if (array_key_exists($field, $data)) {
                $data[$field] = '[FILTERED]';
            }
        }

        return $data;
    }

    /**
     * Store audit log in database (optional)
     */
    protected function storeAuditLog(array $auditData): void
    {
        // Implement database storage if needed
        // Example: AuditLog::create($auditData);
        
        // For now, we're just using file logging
    }

    /**
     * Get audit history for this model
     */
    public function getAuditHistory(): array
    {
        // This would return audit history from database if implemented
        return [];
    }

    /**
     * Create a manual audit entry
     */
    public function auditManual(string $event, array $data = [], string $notes = ''): void
    {
        $auditData = [
            'event' => $event,
            'model' => get_class($this),
            'model_id' => $this->getKey(),
            'table' => $this->getTable(),
            'user_id' => Auth::id(),
            'user_email' => Auth::check() ? Auth::user()->email : 'system',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url' => request()->fullUrl(),
            'timestamp' => now()->toISOString(),
            'data' => $this->filterSensitiveData($data),
            'notes' => $notes,
        ];

        Log::channel('audit')->info("Manual audit: {$event}", $auditData);
        $this->storeAuditLog($auditData);
    }
}