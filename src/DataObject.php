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

class DataObject extends \SagoBoot\Framework\Illuminate\Support\DataObject
{
	protected $relatedMethods = [];

	public function __construct( array $data = [] )
	{
		parent::__construct( $data );
	}

	public function __call( $method, $args ) {
		try {
			$data = parent::__call( $method, $args );
		} catch (\Exception $e) {
			throw $e;
		}

		if (is_null($data)) {
			if (isset($this->relatedMethods[$method])) {
				return $this->relatedMethods[$method]();
			}

			$related_method = "_{$method}";
			if (method_exists($this, $related_method)) {
				$data = $this->{$related_method}();
				$this->relatedMethods[$method] = $related_method;
			}
		}
		
		return $data;
	}
}