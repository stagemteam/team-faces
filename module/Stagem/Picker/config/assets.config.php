<?php
namespace Stagem\Picker;

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
            //'@picker_css',
            '@picker_js',
        ],
    ],
    'modules' => [
        __NAMESPACE__ => [
            'root_path' => __DIR__ . '/../view/assets',
            'collections' => [
                'picker_js' => [
                    'assets' => [
                        'js/picker.js',
                    ],
                ],
            ],
        ],
    ],
];