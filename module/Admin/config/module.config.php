<?php
return array(
    'doctrine' => array(
        'driver' => array(
            // overriding zfc-user-doctrine-orm's config
            'zfcuser_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Admin/Entity'),
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Admin\Entity' => 'zfcuser_entity',
                ),
            ),
        ),
    ),
);