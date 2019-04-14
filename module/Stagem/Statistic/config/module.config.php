<?php
/**
 * The MIT License (MIT)
 * Copyright (c) 2018 Stagem Team
 * This source file is subject to The MIT License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 *
 * @category Stagem
 * @package Stagem_Shipment
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Stagem\Statistic;

return [

    //'cron' => require 'cron.config.php',

    //'importer' => require 'importer.config.php',

    //'navigation' => require 'navigation.config.php',

    'actions' => [
        'statistic' => __NAMESPACE__ . '\Action',
        'statistic-grid' => __NAMESPACE__ . '\Action\Grid',
    ],

    'view_manager' => [
        'prefix_template_path_stack' => [
            'statistic::' => __DIR__ . '/../view',
        ],
    ],

    'dependencies' => [
        'factories' => [
            //Parser\CustomerParser::class => Parser\Factory\CustomerParserFactory::class,
        ],
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Model'],
            ],
            'orm_default' => [
                'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    __NAMESPACE__ . '\Model' => __NAMESPACE__ . '_driver',
                ],
            ],
        ],
    ],
];