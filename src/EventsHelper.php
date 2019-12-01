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

use SagoBoot\Framework\Illuminate\Support\Helper;
use SagoBoot\Traits\Container as ContainerTrait;
use SagoBoot\Traits\Event as EventTrait;

class EventsHelper extends \SagoBoot\Framework\Illuminate\Events\Dispatcher implements Helper
{
	use ContainerTrait, EventTrait;
}