<?php

use App\Models\Audit;
use App\Models\Assignment;
use App\Models\ProductionLine;
use App\Models\User;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Ensure we have data
$line = ProductionLine::first();
$user = User::first();

if (!$line || !$user) {
    echo "SKIPPING: Need at least 1 line and 1 user in DB.\n";
    exit;
}

// Create a dummy assignment if needed (in memory)
$assignment = new Assignment();
$assignment->id = 123; // ID to hash
$assignment->line_id = $line->id; // FK to hash
$assignment->technician_id = $user->id; // FK to hash
$assignment->supervisor_id = $user->id; // FK to hash

echo "\n--- Assignment Test ---\n";
$array = $assignment->toArray();
echo "ID (Expected Hash): " . $array['id'] . "\n";
echo "Line ID (Expected Hash): " . $array['line_id'] . "\n";
echo "Tech ID (Expected Hash): " . $array['technician_id'] . "\n";

$audit = new Audit();
$audit->id = 456;
$audit->assignment_id = $assignment->id;
$audit->line_id = $line->id;

echo "\n--- Audit Test ---\n";
$auditArray = $audit->toArray();
echo "ID (Expected Hash): " . $auditArray['id'] . "\n";
echo "Line ID (Expected Hash): " . $auditArray['line_id'] . "\n";
echo "Assignment ID (Expected Hash): " . $auditArray['assignment_id'] . "\n";

if (is_numeric($array['line_id'])) {
    echo "\nFAILED: line_id is still numeric!\n";
} else {
    echo "\nSUCCESS: Foreign keys are hashed.\n";
}
