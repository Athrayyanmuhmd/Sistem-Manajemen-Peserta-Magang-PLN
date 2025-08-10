<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Intern;
use Carbon\Carbon;

class UpdateInternProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'intern:update-progress {--force : Force update all interns}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update intern progress based on real-time dates automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting daily intern progress update...');
        
        $activeInterns = Intern::where('status', 'active')
            ->whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->get();
        
        if ($activeInterns->isEmpty()) {
            $this->info('ℹ️  No active interns found to update.');
            return 0;
        }
        
        $updatedCount = 0;
        $completedCount = 0;
        $progressBar = $this->output->createProgressBar($activeInterns->count());
        
        foreach ($activeInterns as $intern) {
            $oldProgress = $intern->completion_percentage;
            $oldStatus = $intern->status;
            
            // Update progress otomatis
            $wasUpdated = $intern->updateProgressAutomatically();
            
            if ($wasUpdated) {
                $updatedCount++;
                
                // Log jika status berubah menjadi completed
                if ($oldStatus !== $intern->fresh()->status && $intern->fresh()->status === 'completed') {
                    $completedCount++;
                    $this->line('');
                    $this->info("✅ {$intern->name} - Status changed to COMPLETED (Progress: {$oldProgress}% → 100%)");
                } elseif ($this->option('force') || $oldProgress !== $intern->fresh()->completion_percentage) {
                    $newProgress = $intern->fresh()->completion_percentage;
                    $this->line('');
                    $this->comment("📊 {$intern->name} - Progress updated: {$oldProgress}% → {$newProgress}%");
                }
            }
            
            $progressBar->advance();
        }
        
        $progressBar->finish();
        $this->line('');
        $this->line('');
        
        // Summary
        $this->info("📈 Progress Update Summary:");
        $this->table(['Metric', 'Count'], [
            ['Total Active Interns', $activeInterns->count()],
            ['Updated', $updatedCount],
            ['Newly Completed', $completedCount],
            ['No Changes', $activeInterns->count() - $updatedCount],
        ]);
        
        // Additional statistics
        $todayStats = $this->getTodayStatistics();
        $this->line('');
        $this->info("📊 Today's Statistics:");
        $this->table(['Status', 'Count'], $todayStats);
        
        $this->info('✨ Intern progress update completed successfully!');
        
        return 0;
    }
    
    private function getTodayStatistics(): array
    {
        $today = Carbon::today();
        
        return [
            ['Starting Today', Intern::whereDate('start_date', $today)->count()],
            ['Ending Today', Intern::whereDate('end_date', $today)->where('status', 'active')->count()],
            ['Overdue', Intern::where('status', 'active')->whereDate('end_date', '<', $today)->count()],
            ['Active Total', Intern::where('status', 'active')->count()],
            ['Completed Total', Intern::where('status', 'completed')->count()],
        ];
    }
}
