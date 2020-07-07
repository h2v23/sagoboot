<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot;

/**
 * Class Loader
 * @package SagoBoot
 */
abstract class Loader implements \SagoBoot\Support\Module
{
    protected $_loaded = false;

    /**
     * @param Modules\Loader $loader
     * @return mixed
     * @since 1.0.0
     */
    abstract public function autoload(Modules\Loader $loader);

    /**
     * Determine object loaded
     * @param null $loaded
     * @since 1.0.0
     * @return bool
     */
    public function isLoaded($loaded = null)
    {
        if (is_null($loaded)) {
            return $this->_loaded;
        } else {
            $this->_loaded = $loaded;
        }
    }
}
