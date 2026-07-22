<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Starting SQLite to MySQL Data Import...\n";

$sqlitePath = __DIR__ . '/database/database.sqlite';

if (!file_exists($sqlitePath)) {
    die("Error: SQLite file not found at {$sqlitePath}\n");
}

$sqlitePdo = new PDO("sqlite:" . $sqlitePath);
$sqlitePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get all tables except sqlite system tables and migrations
$tablesStmt = $sqlitePdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' AND name != 'migrations'");
$tables = $tablesStmt->fetchAll(PDO::FETCH_COLUMN);

// Order tables to prevent foreign key errors (parents first)
$priorityTables = [
    'users',
    'permissions',
    'roles',
    'model_has_permissions',
    'model_has_roles',
    'role_has_permissions',
    'blog_categories',
    'pages',
    'settings',
    'projects',
    'resume_items',
    'blog_posts',
    'blog_comments',
];

// Merge priority tables with any remaining tables
$orderedTables = array_unique(array_merge($priorityTables, $tables));

Schema::disableForeignKeyConstraints();

foreach ($orderedTables as $table) {
    if (!in_array($table, $tables)) {
        continue;
    }

    if (!Schema::hasTable($table)) {
        echo "Skipping table {$table} (does not exist in target database)\n";
        continue;
    }

    echo "Importing table: {$table}... ";

    $stmt = $sqlitePdo->prepare("SELECT * FROM {$table}");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        echo "0 rows.\n";
        continue;
    }

    DB::table($table)->truncate();
    
    // Chunk inserts to avoid large query limits
    $chunks = array_chunk($rows, 100);
    foreach ($chunks as $chunk) {
        DB::table($table)->insert($chunk);
    }

    echo count($rows) . " rows imported successfully!\n";
}

Schema::enableForeignKeyConstraints();

echo "\nData import completed successfully!\n";
