<?php
// Simple seed runner for local dev: runs schema + accounts + listings seeds
// Usage: http://localhost/kabalayan/seeds/run_seeds.php or `php seeds/run_seeds.php`

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/Database.php';

function run_sql_file(PDO $pdo, string $path): array {
    if (!file_exists($path)) {
        return [false, "File not found: $path"]; 
    }
    $sql = file_get_contents($path);
    if ($sql === false) { return [false, "Unable to read: $path"]; }

    try {
        $pdo->beginTransaction();
        // Split on semicolons that end statements. This is simple; good enough for our seeds.
        $stmts = array_filter(array_map('trim', preg_split('/;\s*\n/Us', $sql)));
        foreach ($stmts as $stmt) {
            if ($stmt === '' || stripos($stmt, '--') === 0) continue;
            $pdo->exec($stmt);
        }
        $pdo->commit();
        return [true, basename($path) . ' executed'];
    } catch (Throwable $e) {
        if ($pdo->inTransaction()) { $pdo->rollBack(); }
        return [false, basename($path) . ' error: ' . $e->getMessage()];
    }
}

$pdo = Database::getInstance()->getConnection();
$files = [
    __DIR__ . '/schema.sql',
    __DIR__ . '/seed_accounts.sql',
    __DIR__ . '/listings_seed.sql',
];

$results = [];
foreach ($files as $f) {
    $results[] = run_sql_file($pdo, $f);
}

$ok = true; foreach ($results as $r) { if (!$r[0]) { $ok = false; break; } }

header('Content-Type: text/plain');
echo "Seed Runner\n===========\n";
foreach ($results as $r) {
    echo ($r[0] ? '[OK] ' : '[ERR] ') . $r[1] . "\n";
}
echo "\n" . ($ok ? 'All seeds executed successfully.' : 'One or more seeds failed. Check logs.');
