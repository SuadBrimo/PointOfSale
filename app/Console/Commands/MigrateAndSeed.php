<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateAndSeed extends Command
{
    protected $signature = 'migrate:seed';

    protected $description = 'Run migrations and seed the database';

    public function handle()
    {
        $this->createDatabase();

        $this->call('migrate');
        $this->call('db:seed');
    }

    protected function createDatabase()
    {
        $databaseName = env('DB_DATABASE');
        $connection = config('database.default');

        // Check if the database exists
        if (!DB::connection($connection)->getDatabaseName()) {
            // Database doesn't exist, create it
            DB::connection($connection)->statement("CREATE DATABASE IF NOT EXISTS $databaseName");
            $this->info("Database '$databaseName' created successfully.");
        } else {
            $this->info("Database '$databaseName' already exists.");
        }
    }
}
