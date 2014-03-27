<?php

 return array(
     'controllers' => array(
         'invokables' => array(
             'Forum\Controller\Forum' => 'Forum\Controller\ForumController',
         ),
     ),
     
      // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'forum' => array(
                'type'    => 'segment',
                'options' => array(
                     'route'    => '/forum[/][:action][/:id]',
                     'constraints' => array(
                         'action'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'      => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Forum\Controller\Forum',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'forum' => __DIR__ . '/../view',
         ),
     ),
 );

?>