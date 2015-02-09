<?php
return array(
    'doctrine' => array(

        'driver' => array(
            // overriding zfc-user-doctrine-orm's config
            'zfcuser_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/User/Entity'),
            ),

            'orm_default' => array(
                'drivers' => array(
                    'User\Entity' => 'zfcuser_entity',
                ),
            ),
        ),
    ),

    'router' => array(
        'routes' => array(
            'user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/user[/:action]',
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'zfcuser-login' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        'controller' => 'zfcuser',
                        'action' => 'login',
                    ),
                ),
            ),
            'registration' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/register',
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action'    =>  'registration'
                    ),
                ),
            ),
            'admin-user' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin-users[/:action[/:id]][/:page[/:role]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                        'page'     => '[0-9]+',
                        'role'  => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Admin',
                        'action'     => 'index',
                        'page'=>1
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'layout/authenticate'           => __DIR__ . '/../view/layout/authenticate.phtml',
            'user-paginator-slide' => __DIR__ . '/../view/user/admin/slidePaginator.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'User\Controller\Index' => 'User\Controller\IndexController',
            'User\Controller\Admin' => 'User\Controller\AdminController',
        ),
    ),

    'bjyauthorize' => array(
        'guards' => array(
           'BjyAuthorize\Guard\Route' => array(
                array('route' => 'user', 'roles' => array( 'user')),
                array('route' => 'zfcuser-login', 'roles' => array( 'guest')),
                array('route' => 'registration', 'roles' => array('guest')),
                array('route' => 'admin-user', 'roles' => array('admin')),
            ),
        ),
    ),

    
);