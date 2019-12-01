<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot;

use SagoBoot\Framework\Application as ApplicationFactory;
use SagoBoot\Traits\Event as EventTrait;
use SagoBoot\Traits\Filter as FilterTrait;

class Application extends ApplicationFactory
{
	use EventTrait, FilterTrait;

	const BOOT_EVENT_NAME = 'sagoboot:boot';

	const VERSION = '1.0.0';

    /**
     * The available container bindings and their respective load methods.
     *
     * @var array
     */
    protected $availableBindings = [
        'EventsHelper' => 'registerEventBindings',
        'FiltersHelper' => 'registerFilterBindings',
    ];

    protected $booted = false;

    /**
     * Application constructor.
     * @param null $basePath
     * @throws Framework\Illuminate\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    public function __construct($basePath = null)
    {
        parent::__construct($basePath);
        // Bind to system default packages
        $this->registerAutoloadBindings();
        // Let's type in terminal
        $this->command();
    }

	/**
	 * @return $this
	 * @throws Framework\Illuminate\Container\BindingResolutionException
	 * @throws \ReflectionException
	 */
    public function boot()
    {
        if (!$this->booted) {
            $this->booted = true;
            parent::boot();
	        $this->make('EventsHelper')->fire(self::BOOT_EVENT_NAME);
        }

        return $this;
    }

    public function getVersion()
    {
		return self::VERSION;
    }

    /**
     * Register the core container aliases.
     * Used in Dependency Injection.
     * @see docs/php/DependencyInjection.md
     */
    protected function registerContainerAliases()
    {
        parent::registerContainerAliases();
        $this->aliases = [
            // Inner bindings.
            'SagoBoot\Application' => 'App',
            'SagoBoot\Framework\Application' => 'App',
            'SagoBoot\Framework\Illuminate\Container\Container' => 'App',
            'SagoBoot\Framework\Illuminate\Contracts\Container\Container' => 'App',
            'SagoBoot\Framework\Illuminate\Events\Dispatcher' => 'EventsHelper',
            'SagoBoot\Framework\Illuminate\Filters\Dispatcher' => 'FiltersHelper',
        ];
    }

    /**
     * Register container bindings for the application.
     *
     * @return $this
     * @throws Framework\Illuminate\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    protected function registerEventBindings()
    {
        $this->singleton(
            'EventsHelper',
            function (Application $app) {
                return (new EventsHelper($app));
            }
        );

        return $this;
    }

    /**
     * Register container bindings for the application.
     *
     * @return $this
     * @throws Framework\Illuminate\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    protected function registerFilterBindings()
    {
        $this->singleton(
            'FiltersHelper',
            function (Application $app) {
                return (new FiltersHelper($app));
            }
        );

        return $this;
    }

    /**
     * @return void
     * @throws Framework\Illuminate\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    protected function registerAutoloadBindings()
    {
        // add Default module
        $this->addComponent('StrHelper', 'SagoBoot\\StrHelper', true);
        $this->addComponent('Loader', 'SagoBoot\\Loader', true);
        $this->addComponent('Cli', 'SagoBoot\\Cli', true);
    }


    protected function command() :void
    {
	    if (!$this->isCli()) {
			return;
	    }

	    /**
	     * channel 9 for commander
	     */
	    $this->addEvent(self::BOOT_EVENT_NAME, function () {
		    $this->make('Cli')->run();
	    }, 9);
    }

    protected function isCli()
    {
    	return (php_sapi_name() === 'cli');
    }
}