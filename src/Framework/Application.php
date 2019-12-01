<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot\Framework;

if (!defined('SGB_PATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use SagoBoot\Framework\Illuminate\Container\Container as ContainerContract;

/**
 * Class Application.
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
     */
    protected $aliases;

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
     *
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
     * @throws Illuminate\Container\BindingResolutionException
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
     * @param $pattern - file pattern to search.
     * @param int $flags
     *
     * @return array
     */
    public function glob($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);

        return $files === false ? [] : (array)$files;
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
     * @param $componentName
     * @param $componentController
     * @param bool $singleton
     *
     * @return $this
     * @throws Illuminate\Container\BindingResolutionException
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