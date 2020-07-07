<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Modules;

use SagoBoot\EventsHelper as EventsHelperAlias;
use SagoBoot\Framework\Events\Dispatcher;
use SagoBoot\Support\Traits\Container as ContainerTrait;
use SagoBoot\Support\Traits\Event as EventTrait;

/**
 * Class EventsHelper
 * @package SagoBoot\Modules
 */
class EventsHelper extends Dispatcher implements EventsHelperAlias
{
	use ContainerTrait, EventTrait;
}