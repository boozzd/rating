<?php
return array(
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host' => 'localhost',
					'port' => '3306',
					'user' => 'root',
					'password' => '123456',
					'dbname' => 'rating',
					'driverOptions' => array(
						1002=>'SET NAMES utf8'
					)
				)
			)
		)
	)
);