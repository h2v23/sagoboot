<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot;

if (!defined('SGB_PATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}


class Loader implements \SagoBoot\Framework\Illuminate\Support\Module
{
    /**
     * @var \SagoBoot\Framework\Application|Application
     */
    protected $app;

	/**
	 * Autoload constructor.
	 *
	 * @param Application $app
	 * @param mixed $packages
	 *
	 * @throws \Exception
	 */
    public function __construct(\SagoBoot\Application $app, $packages = false)
    {
        $this->app = $app;
	    $args = func_get_args();
        if (count($args)>1) {
	        array_shift($args);
            $this->init($args);
        }
    }

    public function init($packages)
    {
        if (is_string($packages)) {
            if (file_exists($packages)) {
                /** @var array $packages */
                $packages = require $packages;
            }
        }

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
                if (class_exists($component['abstract'])) {
                    $this->app->addComponent(
                        $component['name'],
                        $component['abstract'],
                        $component['singleton']
                    );
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
}
