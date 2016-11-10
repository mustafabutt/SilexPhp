<?php
                 $app = new Silex\Application();
                 $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
                     'dbs.options' => array (
                         'mysql_read' => array(
                             'driver'    => 'pdo_mysql',
                             'host'      => 'localhost',
                             'dbname'    => 'test',
                             'user'      => 'root',
                             'password'  => '',
                             'charset'   => 'utf8',
                         ),
                     ),
                 ));
  