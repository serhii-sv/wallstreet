<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Backup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:backup {--mode=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {\Log::critical(self::class);
        switch ($this->option('mode')) {
            case 'only-files':
                Artisan::call('backup:run', ['--only-files' => true]);
                break;
            case 'only-db':
                Artisan::call('backup:run', ['--only-db' => true]);
                break;
            default:
                Artisan::call('backup:run');
                break;
        }

        $backups = Storage::disk('do_spaces')->files(config('backup.backup.name'));

        $lastBackup = last($backups);
        $firstBackup = $backups[0];

        Storage::disk('do_spaces')->setVisibility($lastBackup, 'public');

        if (count($backups) == 10) {
            Storage::disk('do_spaces')->delete($firstBackup);
            \App\Models\Backup::orderBy('created_at', 'desc')->first()->delete();
        }

        \App\Models\Backup::create([
            'path' => $lastBackup,
            'size' => Storage::disk('do_spaces')->size($lastBackup)
        ]);

        return true;
    }
}
