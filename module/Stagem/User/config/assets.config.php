<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.09.2018
 * Time: 10:16
 */

namespace Stagem\User;

return [

    'routes' => [
        'admin(.*)' => [
            '@user_css',
            '@user_js',
        ],
    ],

    'default' => [
        'assets' => [
            '@user_css',
            '@user_js',
        ],
    ],

    'modules' => [
        __NAMESPACE__ => [
            'root_path' => __DIR__ . '/../view/assets',
            'collections' => [
                'user_js' => [
                    'assets' => [
                        'js/user.js',
                        'js/popup.js',
                        'js/jquery.snap.js',
                        'js/jquery.polartimer.js'
                    ],
                ],
                'user_css' => [
                    'assets' => [
                        'css/user.css',
                        'css/popup.css'
                    ],
                ],
                'user_images' => [
                    'assets' => [
                        'img/*.png',
                        'img/*.jpg',
                    ],
                    'options' => [
                        //'move_raw' => true,
                        //'targetPath' => 'jquery-ui/images',
                        'disable_source_path' => true,
                        'move_raw' => true,
                        'targetPath' => 'images',
                    ]
                ],
            ],
        ],
    ],
];