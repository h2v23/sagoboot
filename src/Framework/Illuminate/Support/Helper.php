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
 * Empty interface to allow use in autoloader and instanceof methods.
 *
 * Interface Helper.
 */
interface Helper
{
}
