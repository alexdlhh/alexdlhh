<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);


//escribimos en access.log la ip que nos visita
if (getenv('HTTP_CLIENT_IP')) {
    $ip = getenv('HTTP_CLIENT_IP');
  } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
    $ip = getenv('HTTP_X_FORWARDED_FOR');
  } elseif (getenv('HTTP_X_FORWARDED')) {
    $ip = getenv('HTTP_X_FORWARDED');
  } elseif (getenv('HTTP_FORWARDED_FOR')) {
    $ip = getenv('HTTP_FORWARDED_FOR');
  } elseif (getenv('HTTP_FORWARDED')) {
    $ip = getenv('HTTP_FORWARDED');
  } else {
    // Método por defecto de obtener la IP del usuario
    // Si se utiliza un proxy, esto nos daría la IP del proxy
    // y no la IP real del usuario.
    $ip = $_SERVER['REMOTE_ADDR'];
}
$fecha = date("Y-m-d H:i:s");
$fp = fopen('access.log', 'a');
fwrite($fp, $ip . " - - [" . $fecha . "] " . $_SERVER['REQUEST_METHOD'] . " " . $_SERVER['REQUEST_URI'] . " " . $_SERVER['SERVER_PROTOCOL'] . "\n");
fclose($fp);
