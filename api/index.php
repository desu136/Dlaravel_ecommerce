<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode check
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
    exit;
}

// Composer autoload
require __DIR__.'/../vendor/autoload.php';

// Bootstrap the application
$app = require __DIR__.'/../bootstrap/app.php';

<<<<<<< HEAD
$app->handleRequest(Request::capture());
<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode check
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
    exit;
}

// Composer autoload
require __DIR__.'/../vendor/autoload.php';

// Bootstrap the application
$app = require __DIR__.'/../bootstrap/app.php';

=======
>>>>>>> 2ca45be2da60b8d5c4f04e081e4ca144ed64777a
/** @var Kernel $kernel */
$kernel = $app->make(Kernel::class);

// Handle the request
$response = $kernel->handle(
    $request = Request::capture()
);

// Send response to browser
$response->send();

// Terminate kernel (important for queues, sessions, etc.)
$kernel->terminate($request, $response);
