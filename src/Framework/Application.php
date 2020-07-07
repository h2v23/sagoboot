<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Framework;


use SagoBoot\Framework\Container\Container as ContainerContract;

/**
 * Class Application
 * @package SagoBoot\Framework
 */
class Application extends ContainerContract
{
    /**
     * The available container bindings and their respective load methods.
     *
     * @var array
     */
    protected $availableBindings = [];

    /**
     * The service binding methods that have been executed.
     *
     * @var array
     */
    protected $ranServiceBinders = [];

    /**
     * The loaded service providers.
     *
     * @var array
     */
    protected $loadedProviders = [];

    protected $basePath;
    /**
     * @var array
     * TODO: Change to protected after dev
     */
    public $aliases;

    /**
     * Create a new Lumen application instance.
     *
     * @param  string|null $basePath
     */
    public function __construct($basePath)
    {
        $this->basePath = $basePath;
        $this->bootstrapContainer();
    }

    /**
     * Bootstrap the application container.
     */
    protected function bootstrapContainer()
    {
        static::setInstance($this);

        $this->instance('App', $this);

        $this->registerContainerAliases();
    }

    /**
     * Boot the application
     */
    public function boot()
    {
    }

    /**
     * Resolve the given type from the container.
     *
     * @param string $abstract
     * @param array $parameters
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function make($abstract, $parameters = [])
    {
        $abstract = $this->getAlias($abstract);
        if (array_key_exists($abstract, $this->availableBindings)
            && !array_key_exists($this->availableBindings[ $abstract ], $this->ranServiceBinders)
        ) {
            $this->{$method = $this->availableBindings[ $abstract ]}();

            $this->ranServiceBinders[ $method ] = true;
        }

        return parent::make($abstract, $parameters);
    }

    /**
     * Register the core container aliases.
     */
    protected function registerContainerAliases()
    {
        $this->aliases = [];
    }

    /**
     * Get plugin dir path + custom dir.
     *
     * @param $path
     *
     * @return string
     */
    public function path($path = '')
    {
        return $this->basePath . ltrim($path, '\//');
    }

    /**
     * Get plugin dir path + custom dir.
     *
     * @param $path
     *
     * @return string
     */
    public function addPath($path)
    {
        return $this->basePath = $path;
    }

    /**
     * @param $componentName
     * @param $componentController
     * @param bool $singleton
     *
     * @return $this
     * @throws \ReflectionException
     */
    public function addComponent($componentName, $componentController, $singleton = true)
    {
        if (!$this->bound($componentController)) {
            // Not bound
            if ($singleton) {
                $this->singleton($componentController);
            }
            $this->alias($componentController, $componentName);
        }

        return $this;
    }
}
