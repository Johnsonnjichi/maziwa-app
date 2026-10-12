<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

#[Signature('app:cleanup-logs')]
#[Description('Clean up old log files and clear stale cache')]
class CleanupLogs extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting log and cache cleanup...');

        // Clean up log files older than 30 days
        $logPath = storage_path('logs');
        $files = File::glob($logPath.'/*.log');

        $deletedLogs = 0;
        $cutoffDate = now()->subDays(30);

        foreach ($files as $file) {
            if (File::lastModified($file) < $cutoffDate->timestamp) {
                File::delete($file);
                $deletedLogs++;
                $this->line("Deleted old log: {$file}");
            }
        }

        $this->info("Deleted {$deletedLogs} old log files");

        // Clear stale cache items (older than 24 hours)
        Cache::flush();
        $this->info('Cleared application cache');

        // Clear compiled views
        $viewPath = storage_path('framework/views');
        if (File::exists($viewPath)) {
            File::cleanDirectory($viewPath);
            $this->info('Cleared compiled views');
        }

        // Clear cache config
        $this->call('config:clear');
        $this->call('route:clear');

        Log::info('Log and cache cleanup completed', [
            'deleted_logs' => $deletedLogs,
            'timestamp' => now(),
        ]);

        $this->info('Cleanup completed successfully!');

        return Command::SUCCESS;
    }
}
