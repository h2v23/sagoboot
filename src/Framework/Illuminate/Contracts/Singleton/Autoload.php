<?php
namespace SagoBoot\Framework\Illuminate\Contracts\Singleton;

interface Autoload
{
	/**
	 * Break point for main functions come here
	 * @return mixed
	 */
	public function boot();
}