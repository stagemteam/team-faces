<?php

namespace Stagem\User;

//use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'assetic_configuration' => require_once 'assets.config.php',
    // mvc
    'view_manager' => [
        'template_map' => [
            'layout::admin-login' => __DIR__ . '/../view/layout/admin/login.phtml',
        ],
        'prefix_template_path_stack' => [
            'user::' => __DIR__ . '/../view/user',
        ],
    ],
    // middleware
    'templates' => [
        'map' => [
            'layout::admin-login' => __DIR__ . '/../view/admin/layout/login.phtml',
        ],
        'paths' => [
            'admin-user' => [__DIR__ . '/../view/admin/user'],
            'widget' => [__DIR__ . '/../view/admin/widget'],
        ],
    ],
];