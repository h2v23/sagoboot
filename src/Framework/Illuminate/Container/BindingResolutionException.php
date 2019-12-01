<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot\Framework\Illuminate\Container;

if (!defined('SGB_PATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use Exception;

/**
 * Class BindingResolutionException.
 */
class BindingResolutionException extends Exception
{
}
