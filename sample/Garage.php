<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Sample;

/**
 * Class Garage
 * @package Sagoboot\Sample
 */
class Garage
{
    /**
     * @var Car\CarInterface
     */
    protected $car;

    /**
     * Garage constructor.
     * @param Car\CarInterface $car
     */
    public function __construct(
        Car\CarInterface $car
    )
    {
        $this->car = $car;
    }

    /**
     * Maintenance the car
     */
    public function maintenanceCar()
    {
        $this->car->stop()->setState('maintenance');
    }
}