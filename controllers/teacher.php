<?php
                         namespace Users;
                         use Silex\Application;
                         use Silex\ControllerProviderInterface;
                         use Symfony\Component\HttpFoundation\Request;
                         use Symfony\Component\HttpFoundation\Response;
                          header('Access-Control-Allow-Origin: *');
                         class teacher implements ControllerProviderInterface{
                             public function connect(Application $app){
                                 $controllers = $app['controllers_factory'];
                                  $controllers->get('/teacher', function (Application $app) {
                                     $users = $app['db']->fetchAll('SELECT * FROM teacher');
                                     return json_encode($users);
                                 });
                                 $controllers->get('/teacher/{id}',function(Application $app, $id){
                                     $query = 'SELECT * FROM teacher WHERE id = ?';
                                     $user = $app['db']->fetchAssoc($query, array((int) $id)) or die( mysql_error());
                                     return json_encode($user);
                                 });
                                 $controllers->post('/teacher',function(Application $app, Request $request){
                                     $user = json_decode($request->getContent(),true);
                                     $new_user = array(
                                          'id' => $user['id'],
   'username' => $user['username'],
   'email' => $user['email'],
   'password' => $user['password'],
  
                                     );
                                     $app['db']->INSERT('teacher',$new_user);
                                     $users = $app['db']->fetchAll('SELECT * FROM teacher');
                                     return new Response(json_encode($users) ,201);
                                 });
                                 $controllers->put('/teacher/{id}',function(Application $app, Request $request, $id){
                                     $user = json_decode($request->getContent(),true);
                                     $updateUser = array(
                                          'id' => $user['id'],
   'username' => $user['username'],
   'email' => $user['email'],
   'password' => $user['password'],
  
                                     );
                                     $query = 'UPDATE teacher SET FirstName = ?, LastName = ? WHERE id = ?';
                                     $app['db']->executeUpdate($query,array(
                                                                  'id' => $user['id'],
   'username' => $user['username'],
   'email' => $user['email'],
   'password' => $user['password'],
  
                                                                 )
                                                             ) or die(mysql_error());
                                     $query = 'SELECT * FROM teacher WHERE id = ?';
                                     $user = $app['db']->fetchAssoc($query, array((int) $id)) or die( mysql_error());
                                     return  new response( json_encode($user),200);
                                 });
                                 $controllers->delete('/teacher/{id}',function(Application $app, Request $request, $id){
                                     $app['db']->delete('teacher',array('id' => (int) $id)) or die(mysql_error());
                                     return 'User is Deleted with Id : '.$id;
                                 });
                                 return $controllers;
                             }
                         } 