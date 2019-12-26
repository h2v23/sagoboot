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


abstract class Loader implements \SagoBoot\Support\Module
{
    protected $_loaded = false;

    /**
     * @param Modules\Loader $loader
     * @return mixed
     * @since 1.0.0
     */
    abstract public function autoload(\SagoBoot\Modules\Loader $loader);

    /**
     * Deternime object loaded
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
