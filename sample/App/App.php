<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Sample\App;

/**
 * Class App
 * @package SagoBoot\Sample
 */
class App extends \SagoBoot\Application
{
    /**
     * App constructor.
     * @param null $basePath
     * @throws \ReflectionException
     */
    public function __construct($basePath = null)
    {
        parent::__construct(__DIR__);
    }
}
