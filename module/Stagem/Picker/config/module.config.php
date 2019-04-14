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
 * @package Stagem_Amazon
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Stagem\Picker;

return [
    'assetic_configuration' => require_once 'assets.config.php',

    'actions' => [
        'picker' => __NAMESPACE__ . '\Action',
    ],

    'service_manager' => [
        'aliases' => [
        //    'MarketplaceService' => Service\MarketplaceService::class,
        ],
        'invokables' => [//   Service\MarketplaceService::class => Service\MarketplaceService::class,
        ],
        'factories' => [
            //Model\Table\BestsellerTable::class => TableFactory::class,
            //Action\Dashboard\Admin\TopRatedAction::class => Action\Dashboard\Admin\Factory\TopRatedActionFactory::class,
        ],
    ],

    'view_helpers' => [
        'aliases' => [
            'picker' => View\Helper\PickerHelper::class,
        ],
        'factories' => [
            View\Helper\PickerHelper::class => View\Helper\Factory\PickerHelperFactory::class,
        ]
    ],

    'view_manager' => [
        'template_map' => [
            'widget::picker' => __DIR__ . '/../view/widget/picker.phtml',
        ],
        'prefix_template_path_stack' => [
            'picker::' => __DIR__ . '/../view',
        ],
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Model']
            ],
            'orm_default' => [
                'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    __NAMESPACE__ . '\Model' => __NAMESPACE__ . '_driver'
                ]
            ]
        ],
    ],
];