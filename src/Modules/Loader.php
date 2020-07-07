<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Modules;

use Exception;
use ReflectionException;
use SagoBoot\Application;

/**
 * Class Loader
 * @package SagoBoot\Modules
 */
class Loader extends \SagoBoot\Loader
{
    /**
     * @var Application
     */
    protected $app;
    /**
     * @var \SagoBoot\Loader
     */
    protected $loader;

    /**
     * Autoload constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        if (!$this->isLoaded()) {
            $this->autoload(null);
        }

    }

    /**
     * @return bool
     * @throws Exception
     */
    public function init()
    {
	    $packages = $this->useCache();
	    return $this->loadComponents($packages);
    }

    /**
     * @param $packages
     * @return bool
     * @throws Exception
     */
    protected function loadComponents($packages)
    {
        if (is_array($packages) ) {
            $this->initComponents($packages);
            $this->bootComponents($packages);

            return true;
        } else {
            throw new Exception(
                '[Failed to add] Invalid packages.'
            );
        }
    }

    /**
     * @return array|mixed
     */
    protected function useCache()
    {
        $cache = __DIR__ . '/../cache/autoload.php';
        if (file_exists($cache)) {
        	$components = require_once($cache);
        } else {
	        $components = [];
        }

        return $components;
    }

    /**
     * @param $all
     *
     * @return bool
     * @throws Exception
     */
    public function initComponents($all)
    {
        if (is_array($all)) {
            foreach ($all as $component) {
                $component = $this->unSerializeComponent($component);
                if (class_exists($component['abstract'])) {
                    $this->app->addComponent(
                        $component['name'],
                        $component['abstract'],
                        $component['singleton']
                    );
	                if (isset($component['aliases']) && $component['aliases']) {
	                	foreach ($component['aliases'] as $alias) {
	                		$this->app->alias($component['abstract'], $alias);
		                }
	                }
	                if (isset($component['helper']) && file_exists($component['helper'])) {
                        require $component['helper'];
                    }
                } else {
                    throw new Exception(
                        '[Failed to add] Class doesnt exists ' . $component['abstract'] . ' try composer update'
                    );
                }
            }

            return true;
        }

        return false;
    }

    /**
     * @param $component
     * @return array|string
     */
    private function unSerializeComponent($component)
    {
        if (is_string($component)) {
            $component = [
                'name' => $component,
                'abstract' => $component,
                'make' => false,
                'singleton' => false,
            ];
        } else {
            if(!isset($component['make'])) {
                $component['make'] = false;
            }
            if(!isset($component['singleton'])) {
                $component['singleton'] = false;
            }
            if(!isset($component['name'])) {
                $component['name'] = $component['abstract'];
            }
        }
        return $component;
    }

    /**
     * @param $all
     *
     * @return bool
     * @throws Exception
     */
    public function bootComponents($all)
    {
        if (is_array($all)) {
            foreach ($all as $component) {
                $component = $this->unSerializeComponent($component);
                if (class_exists($component['abstract'])) {
                    if ($component['make']) {
                        $this->app->make(
                            $component['abstract']
                        );
                    }
                } else {
                    throw new Exception(
                        '[Failed to Make] Class doesnt exists ' . $component['abstract'] . ' try composer update'
                    );
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Add path to load
     *
     * @param $path
     * @return bool
     * @since 1.0.0
     * @throws Exception
     */
    public function loadPath($path)
    {
        if (file_exists($path)) {
            $components = require $path;
            return $this->loadComponents($components);
        } else {
            throw new Exception(
                '[Failed to add] Invalid packages path'
            );
        }
    }

    /**
     * @param \SagoBoot\Loader $loader
     */
    public function addLoader(\SagoBoot\Loader $loader)
    {
        if (!$loader->isLoaded()) {
            $loader->autoload( $this );
            $loader->isLoaded(true);
        }
        // Save this object for next request
        $this->loader = $loader;
    }

    /**
     * @inheritDoc
     */
    public function autoload($loader = null)
    {
        $this->init();
    }
}
