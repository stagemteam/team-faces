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
                /*'jqGrid_css' => [
                    'assets' => [
                        'js/jqGrid/lib/css/ui.jqgrid-bootstrap4.css',
                    ],
                ],*/
                'picker_js' => [
                    'assets' => [
                        // assets\js\jqGrid\js\jquery.jqGrid.min.js
                        'js/picker.js',
                    ],
                ],
            ],
        ],
    ],
];