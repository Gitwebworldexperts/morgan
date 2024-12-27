<?php

error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen

require __DIR__.'/vendor/autoload.php'; // Autoload Laravel classes

// Create a new application instance
$app = require_once __DIR__.'/bootstrap/app.php';

// Make sure to run this in the CLI context
if (php_sapi_name() === 'cli') {
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $kernel->bootstrap(); // Bootstrap the application

    use Illuminate\Support\Facades\Artisan;

    // Run the Artisan serve command
    $exitCode = Artisan::call('serve', [
        '--host' => '127.0.0.1',
        '--port' => '8000',
    ]);

    // Output the result if needed
    echo Artisan::output(); // Output the command result

    if ($exitCode !== 0) {
        echo "Error running command: $exitCode\n";
    }
} else {
    echo "This script should be run from the command line.";
}
