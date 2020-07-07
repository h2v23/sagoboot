<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Modules;

use SagoBoot\Framework\Filters\Dispatcher;
use SagoBoot\Support\Traits\Container as ContainerTrait;
use SagoBoot\Support\Traits\Filter as FilterTrait;
use SagoBoot\FiltersHelper as FiltersHelperAlias;

/**
 * Class FiltersHelper
 * @package SagoBoot\Modules
 */
class FiltersHelper extends Dispatcher implements FiltersHelperAlias
{
	use ContainerTrait, FilterTrait;
}