<?php

/*
|--------------------------------------------------------------------------
| Vercel Serverless Entry
|--------------------------------------------------------------------------
|
| Vercel's filesystem is read-only except /tmp, so the demo SQLite database
| lives there. Each cold start gets a fresh database, migrated and seeded.
|
*/

$database = getenv('DB_DATABASE') ?: '/tmp/database.sqlite';

if (getenv('DB_CONNECTION') === 'sqlite' && ! file_exists($database)) {
    touch($database);

    try {
        require __DIR__.'/../vendor/autoload.php';
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->call('migrate', [
            '--force' => true,
            '--seed' => true,
            '--seeder' => 'Database\Seeders\DemoSeeder',
        ]);
    } catch (Throwable $e) {
        unlink($database);
        throw $e;
    }
}

require __DIR__.'/../public/index.php';
