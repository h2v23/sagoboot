<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot;

use SagoBoot\Framework\Application as ApplicationFactory;
use SagoBoot\Support\Traits\Event as EventTrait;
use SagoBoot\Support\Traits\Filter as FilterTrait;
use SagoBoot\Modules\Loader;

class Application extends ApplicationFactory
{
	use EventTrait, FilterTrait;

	const BOOT_EVENT_NAME = 'boot';

	const VERSION = '1.0.0';

    /**
     * The available container bindings and their respective load methods.
     *
     * @var array
     */
    protected $availableBindings = [
        'Autoload' => 'registerAutoloadBindings',
        'EventsHelper' => 'registerEventBindings',
        'FiltersHelper' => 'registerFilterBindings',
    ];

    protected $booted = false;

    /**
     * Application constructor.
     * @param null $basePath
     * @throws Framework\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    public function __construct($basePath = null)
    {
        parent::__construct($basePath);
        $this->make('Autoload');
        $this->command();
    }

	/**
	 * @return $this
	 * @throws Framework\Container\BindingResolutionException
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
	        'SagoBoot\Application'                                        => 'App',
	        'SagoBoot\Framework\Application'                              => 'App',
	        'SagoBoot\Framework\Container\Container'           => 'App',
	        'SagoBoot\Framework\Contracts\Container\Container' => 'App',
	        'SagoBoot\EventsHelper'                                       => 'EventsHelper',
	        'SagoBoot\Modules\EventsHelper'                               => 'EventsHelper',
	        'SagoBoot\Framework\Events\Dispatcher'             => 'EventsHelper',
	        'SagoBoot\FiltersHelper'                                      => 'FiltersHelper',
	        'SagoBoot\Modules\FiltersHelper'                              => 'FiltersHelper',
	        'SagoBoot\Framework\Filters\Dispatcher'            => 'FiltersHelper',
	        'SagoBoot\Loader'                                           => 'Autoload',
	        'SagoBoot\Modules\Loader'                           => 'Autoload',
        ];
    }

    /**
     * Register container bindings for the application.
     *
     * @return $this
     * @throws Framework\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    protected function registerEventBindings()
    {
        $this->singleton(
            'EventsHelper',
            function (Application $app) {
                return (new \SagoBoot\Modules\EventsHelper($app));
            }
        );

        return $this;
    }

    /**
     * Register container bindings for the application.
     *
     * @return $this
     * @throws Framework\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    protected function registerFilterBindings()
    {
        $this->singleton(
            'FiltersHelper',
            function (Application $app) {
                return (new \SagoBoot\Modules\FiltersHelper($app));
            }
        );

        return $this;
    }


    protected function registerAutoloadBindings()
    {
	    $this->singleton(
		    'Autoload',
		    function (Application $app) {
			    return (new Loader($app));
		    }
	    );

	    return $this;
    }


    protected function command() :void
    {
	    if (!$this->isCli()) {
			return;
	    }

	    $this->addEvent(self::BOOT_EVENT_NAME, function () {
		    $this->make('Cli')->run();
	    }, 9);
    }

    protected function isCli()
    {
    	return (php_sapi_name() === 'cli');
    }
}