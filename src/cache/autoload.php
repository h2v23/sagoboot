<?php
return [
    [
        'name' => 'RequestHelper',
        'abstract' => 'SagoBoot\\Modules\\RequestHelper',
        'make' => false,
        'singleton' => true,
        'aliases' => ['SagoBoot\RequestHelper']
    ],
    [
        'name' => 'StrHelper',
        'abstract' => 'SagoBoot\\Modules\\StrHelper',
        'make' => false,
        'singleton' => true,
        'aliases' => ['SagoBoot\StrHelper']
    ],
    [
        'name' => 'DataObject',
        'abstract' => 'SagoBoot\\Support\\DataObject',
        'make' => false,
        'singleton' => true,
        'aliases' => ['SagoBoot\DataObject']
    ],
];