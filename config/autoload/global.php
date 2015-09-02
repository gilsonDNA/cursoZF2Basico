<?php

return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn'    => 'mysql:dbname=zf2_livraria;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF-8\''
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
        )
    )
);
