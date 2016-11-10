<?php
                 require_once __DIR__.'/vendor/autoload.php';
                 $app = new Silex\Application();
                 require_once __DIR__.'/model/teacher.php';
                 require_once __DIR__.'/controllers/teacher.php';
                 
                 use Symfony\Component\HttpFoundation\Request;
                 use Symfony\ComponentHttpFoundationResponse;
                 //use Symfony\Component\HttpFoundation\ParameterBag;
                 $app['debug'] = true;
                 $app->mount('/',new Users\teacher());
   
                 $app->run();
  