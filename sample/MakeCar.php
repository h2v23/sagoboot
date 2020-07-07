<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */
namespace SagoBoot\Sample;


/**
 * Class MakeAHappiness
 * @package Sagoboot\Sample
 */
class MakeCar
{
    public function __construct(
        Garage $garage,
        Car\CarInterface $car
    )
    {

        $car->start()
            ->observerState()
            ->addFuel()
            ->observerState()
            ->stop();

        $garage->maintenanceCar();

        $car->observerState();
    }
}