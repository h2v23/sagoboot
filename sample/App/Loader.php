<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Sample\App;


use SagoBoot\Modules;

/**
 * Class Loader
 * @package SagoBoot\Sample\App
 */
class Loader extends \SagoBoot\Loader
{
    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function autoload(Modules\Loader $loader)
    {
        $loader->loadPath(__DIR__ . '/../autoload.php');
    }
}