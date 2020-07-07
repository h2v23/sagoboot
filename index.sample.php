<?php
try {
    /** @var \SagoBoot\Sample\App\App $app */
    $app = require_once(__DIR__ . "/sample/bootstrap.php");
    $app->boot();
} catch (\Exception $e) {
    echo $e->getMessage();
    exit(1);
}