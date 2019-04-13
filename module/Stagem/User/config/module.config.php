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
            'layout::admin' => __DIR__ . '/../view/layout/admin.phtml',
        ],
        'prefix_template_path_stack' => [
            'user::' => __DIR__ . '/../view/user',
        ],
    ],

];