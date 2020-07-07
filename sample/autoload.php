<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

return [
    ['abstract' => \SagoBoot\Sample\Car\Car::class, 'make' => false, 'singleton' => true, 'aliases' => [ \SagoBoot\Sample\Car\CarInterface::class]],
    ['abstract' => \SagoBoot\Sample\MakeCar::class, 'make' => true, 'singleton' => true],
];