<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot\Framework\Illuminate\Support;

if (!defined('SGB_PATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

/**
 * Allows to make helper to non-singleton, all new request for helper will cause new object creation
 * Interface Immutable
 * @package SagoBoot\Framework\Illuminate\Support
 */
interface Immutable
{
}
