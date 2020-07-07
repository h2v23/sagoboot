<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Sample\Car;

/**
 * Class Fuel
 * @package SagoBoot\Sample\Car
 */
class Fuel
{
    protected $empty = 0;

    /**
     * @return bool
     * @throws \Exception
     */
    public function get()
    {
        if (!$this->empty) {
            $this->empty = 1;
            return true;
        }

        throw new \Exception('Fuel is now empty!!!');
    }
}