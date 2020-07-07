<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot;


use SagoBoot\Support\Helper;

/**
 * Interface RequestHelper
 * @package SagoBoot
 */
interface RequestHelper extends Helper
{
	public function exists($key);


	public function all();

	/**
	 * Retrieve an input item from the request.
	 *
	 * @param  string $key
	 * @param  mixed $default
	 *
	 * @return string|array
	 */
	public function input($key = null, $default = null);

	/**
	 * @return bool
	 */
	public function isPost();

	/**
	 * Retrieve an input item from the request.
	 *
	 * @param  string $key
	 * @param  mixed $default
	 *
	 * @return string|array
	 */
	public function inputJson($key = null, $default = null);

	public function isAjax();
}