<?php


namespace SagoBoot;


interface Cli extends \SagoBoot\Support\Module
{
	/**
	 * Add command to CLI
	 *
	 * @param $commands
	 * @param null $callback
	 * @param string $help
	 * @param string $short_name
	 *
	 * @return mixed
	 */
	public function addCommands($commands, $callback = null, $help = '', $short_name = '');
}