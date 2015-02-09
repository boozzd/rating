<?php
return array(
    'doctrine' => array(

        'driver' => array(
            // overriding zfc-user-doctrine-orm's config
            'admin_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Admin/Entity'),
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Admin\Entity' => 'admin_entity',
                ),
            ),
        ),
    ),

    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin[/:controller[/:action]]',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'column-data' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin-column[/:action[/:type[/:id][/:page]]]',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Columndata',
                        'action' => 'index',
                        'type' => 'rate'
                    ),
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                        'page'     => '[0-9]+',
                        'type' => '[a-zA-Z][a-zA-Z_-]*',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'admin/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Columndata' => 'Admin\Controller\ColumndataController'
        ),
    ),

    'bjyauthorize' => array(
        'guards' => array(
           'BjyAuthorize\Guard\Route' => array(
                array('route' => 'admin', 'roles' => array( 'admin')),
                array('route' => 'column-data', 'roles' => array('admin'))
            ),
        ),
    ),

    
);