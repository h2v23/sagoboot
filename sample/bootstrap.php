<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

require __DIR__ . "./../vendor/autoload.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$app = new \SagoBoot\Sample\App\App();
$app->bind('SagoBoot\Sample\App', 'App', 1);

$app->addEvent('boot', function ( \SagoBoot\Sample\App\Loader $loader) use ($app) {
    /**
     * This event only fire when calling $app->boot();
     */
    $app->make('Autoload')->addLoader($loader);
});

return $app;