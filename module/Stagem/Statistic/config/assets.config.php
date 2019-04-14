<?php
namespace Stagem\Statistic;

return [
    /*'default' => [
        'assets' => [
            '@jqGrid_css',
            '@jqGrid_js',
            //'@grid_css',
            '@grid_js',
        ],
    ],*/
    'routes' => [
        'admin(.*)' => [
            '@statistics_css',
            '@statistics_js',
        ],
    ],
    'modules' => [
        __NAMESPACE__ => [
            'root_path' => __DIR__ . '/../view/assets',
            'collections' => [
                'statistics_css' => [
                    'assets' => [
                        'css/statistics.css',
                    ],
                ],
                'statistics_js' => [
                    'assets' => [
                        // assets\js\jqGrid\js\jquery.jqGrid.min.js
                        'js/statistics.js',
                    ],
                ],
            ],
        ],
    ],
];