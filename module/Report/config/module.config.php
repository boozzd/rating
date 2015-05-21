<?php
return array(
    'doctrine' => array(

        'driver' => array(
            // overriding zfc-user-doctrine-orm's config
            'report_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Report/Entity'),
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Report\Entity' => 'report_entity',
                ),
            ),
        ),
    ),

    'router' => array(
        'routes' => array(
            'admin-unit' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin-unit[/:page[/:num]]',
                    'defaults' => array(
                        'controller' => 'Unit\Controller\Admin',
                        'page' => 1,
                        'action' => 'index',
                    ),
                    'constraints' => array(
                        'page' => '[0-9]+',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_map' => array(
            'unit-paginator-slide' => __DIR__ . '/../view/unit/admin/slidePaginator.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Unit\Controller\Index' => 'Unit\Controller\IndexController',
            'Unit\Controller\Admin' => 'Unit\Controller\AdminController'
        ),
    ),

    'bjyauthorize' => array(
        'guards' => array(
            'BjyAuthorize\Guard\Route' => array(
                array('route' => 'admin-unit', 'roles' => array( 'admin')),
            ),
        ),
    ),


);