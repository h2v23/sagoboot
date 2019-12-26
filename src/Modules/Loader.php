<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot\Modules;

if (!defined('SGB_PATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}


class Loader extends \SagoBoot\Loader
{
    /**
     * @var \SagoBoot\Application
     */
    protected $app;
    /**
     * @var \SagoBoot\Loader
     */
    protected $loader;

    /**
	 * Autoload constructor.
	 *
	 * @param \SagoBoot\Application $app
	 * @param bool $init
	 *
	 * @throws \Exception
	 */
    public function __construct(\SagoBoot\Application $app)
    {
        $this->app = $app;

        if (!$this->isLoaded()) {
            $this->autoload(null);
        }
    }

    public function init()
    {
	    $packages = $this->useCache();
	    return $this->loadComponents($packages);
    }

    protected function loadComponents($packages)
    {
        if (is_array($packages) ) {
            $this->initComponents($packages);
            $this->bootComponents($packages);

            return true;
        } else {
            if (SGB_DEBUG) {
                throw new \Exception(
                    '[Failed to add] Invalid packages.'
                );
            }
        }
        return false;
    }

    protected function useCache()
    {
        $cache = SGB_PATH . 'cache/autoload.php';
        if (file_exists($cache)) {
        	$components = require $cache;
        } else {
	        $components = [];
        }

        return $components;
    }

    /**
     * @param $all
     *
     * @return bool
     * @throws \Exception
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
                } elseif (SGB_DEBUG) {
                    throw new \Exception(
                        '[Failed to add] Class doesnt exists ' . $component['abstract'] . ' try composer update'
                    );
                }
            }

            return true;
        }

        return false;
    }

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
     * @throws \Exception
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
                } elseif (SGB_DEBUG) {
                    throw new \Exception(
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
     * @throws \Exception
     */
    public function loadPath($path)
    {
        if (file_exists($path)) {
            $components = require $path;
            return $this->loadComponents($components);
        } elseif (SGB_DEBUG) {
            throw new \Exception(
                '[Failed to add] Invalid packages path'
            );
        }

        return false;
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
    public function autoload($loader)
    {
        $this->init();
    }
}
