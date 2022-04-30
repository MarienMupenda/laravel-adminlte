<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily backup of database';

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
     */
    public function handle()
    {
        $filename = "backup_" . Carbon::now()->format('Y_m_d_His') . ".gz";

        // $_mysqldump ="/Applications/MAMP/Library/bin/mysqldump";

        $command = "mysqldump --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . storage_path() . "/app/backup/" . $filename;
        //$command = "".env('DUMP_PATH')." --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  > " . storage_path() . "/app/backup/" . $filename;

        $returnVar = NULL;
        $output = NULL;

        exec($command, $output, $returnVar);
        //return 0;
    }
}

