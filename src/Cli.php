<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot;


use SagoBoot\Cli\Exception;
use SagoBoot\Cli\Options;
use SagoBoot\Traits\Container as ContainerTrait;

class Cli extends \SagoBoot\Cli\Cli
{
	use ContainerTrait;

	protected $listenerCommands = [];

	private $firing = false;

	const CLI_EVENT_NAME = 'sagoboot:cli';

	/**
	 * Register options and arguments on the given $options object
	 *
	 * @param Options $options
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	protected function setup( Options $options ) {
		$options->setHelp('SagoBoot Terminal | The mini-framework for scalable PHP application');

		$commands = $this->getListenerCommands();
		if (count($commands)) {
			foreach ($commands as $command_name => $command) {
				$options->registerOption($command_name, $command['help'], $command['short_name']);
			}
		}
	}

	/**
	 * Your main program
	 *
	 * Arguments and options have been parsed when this is run
	 *
	 * @param Options $options
	 *
	 * @return void
	 *
	 * @throws \Exception
	 */
	protected function main( Options $options ) {
		$commands = $this->getListenerCommands();
		$ran = false;
		if (count($commands)) {
			foreach ($commands as $command_name => $command) {
				if ($options->getOpt($command_name)) {
					$this->call($command['callback']);
					$ran = true;
				}
			}
		}

		if ($ran==false) {
			echo $options->help();
		}
	}

	public function addCommands($commands, $callback = null, $help = '', $short_name = '')
	{
		if (is_array($commands)) {
			foreach ($commands as $command) {
				$this->_addCommand(...$command);
			}
		} else {
			$this->_addCommand(...func_get_args());
		}
	}

	private function _addCommand($command_name, $callback = null, $help = '', $short_name = '')
	{
		$command = compact( 'callback', 'short_name', 'help');
		$this->listenerCommands[$command_name] = $command;
	}

	private function getListenerCommands()
	{
		if ($this->firing) {
			return $this->listenerCommands;
		}
		$this->addDefaultCommands();
		// not fire anymore
		// to ignore any duplication system cli command
		$this->firing = true;
		$this->listenerCommands = sgb_filter(self::CLI_EVENT_NAME, $this->listenerCommands, $this);
		return $this->listenerCommands;
	}

	protected function addDefaultCommands()
	{
		$this->_addCommand('version', function (Application $app) {
			echo sprintf('SagoBoot application version is: %s', $app->getVersion()) . PHP_EOL;
		}, 'Get version', 'v');
	}
}