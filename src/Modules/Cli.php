<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot\Modules;


use SagoBoot\Modules\Cli\Colors;
use SagoBoot\Modules\Cli\Exception;
use SagoBoot\Modules\Cli\Options;
use SagoBoot\Support\Traits\Container as ContainerTrait;

class Cli extends \SagoBoot\Modules\Cli\Cli implements \SagoBoot\Cli
{
	use ContainerTrait;

	protected $listenerCommands = [];

	private $firing = false;

	const CLI_EVENT_NAME = 'cli';

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
		$options->setHelp(
			sprintf("SagoBoot Terminal | The mini-framework for scalable PHP application\n Getting start with %s to retrieve %s instance",
				$this->colors->wrap('sgb_cli()',Colors::C_GREEN),
				$this->colors->wrap(__CLASS__,Colors::C_GREEN)
			)
		);

		$commands = $this->getListenerCommands();
		if (count($commands)) {
			foreach ($commands as $command_name => $command) {
				$options->registerOption($command_name, $command['help'], $command['short_name']);
			}
		}
	}

	/**
	 * Bind again
	 */
	public function run() {
		parent::run();
		$this->firing = false;
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
					$this->call($command['callback'], $options->getArgs());
					$ran = true;
				}
			}
		}

		if ($ran==false) {
			echo $options->help();
		}
	}

    /**
     * @param $commands
     * @param null $callback
     * @param string $help
     * @param string $short_name
     * @return mixed|void
     */
	public function addCommands($commands, $callback = null, $help = '', $short_name = '')
	{
		if (is_array($commands)) {
            /**
             * Is a multiple commands
             */
			foreach ($commands as $command) {
				$this->_addCommand(...$command);
			}
		} else {
            /**
             * Add single command
             */
			$this->_addCommand(...func_get_args());
		}
	}

    /**
     * @param $command_name
     * @param null $callback
     * @param string $help
     * @param string $short_name
     */
	private function _addCommand($command_name, $callback = null, $help = '', $short_name = '')
	{
		$command = compact( 'callback', 'short_name', 'help');
		$this->listenerCommands[$command_name] = $command;
	}

    /**
     * List all the command in hook
     * @return array
     */
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

    /**
     * @return void
     */
	protected function addDefaultCommands()
	{
		$this->_addCommand('version', function (\SagoBoot\Application $app) {
			echo sprintf('SagoBoot application version is: %s',
					$app->getVersion()
			     ) . PHP_EOL;
		}, 'Get version', 'v');
	}
}