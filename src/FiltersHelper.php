<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot;

if (!defined('SGB_PATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit;
}

use SagoBoot\Traits\Container as ContainerTrait;
use SagoBoot\Traits\Filter as FilterTrait;
use SagoBoot\Framework\Illuminate\Support\Helper;

class FiltersHelper extends \SagoBoot\Framework\Illuminate\Filters\Dispatcher implements Helper
{
	use ContainerTrait, FilterTrait;
}