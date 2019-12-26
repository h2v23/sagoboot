<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot\Modules;

if (!defined('SGB_PATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit;
}

use SagoBoot\Framework\Filters\Dispatcher;
use SagoBoot\Support\Traits\Container as ContainerTrait;
use SagoBoot\Support\Traits\Filter as FilterTrait;
use SagoBoot\FiltersHelper as FiltersHelperAlias;

class FiltersHelper extends Dispatcher implements FiltersHelperAlias
{
	use ContainerTrait, FilterTrait;
}