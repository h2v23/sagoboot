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

use SagoBoot\EventsHelper as EventsHelperAlias;
use SagoBoot\Framework\Events\Dispatcher;
use SagoBoot\Support\Traits\Container as ContainerTrait;
use SagoBoot\Support\Traits\Event as EventTrait;

class EventsHelper extends Dispatcher implements EventsHelperAlias
{
	use ContainerTrait, EventTrait;
}