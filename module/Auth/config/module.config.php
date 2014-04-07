<?php

 return array(
     'controllers' => array(
         'invokables' => array(
             'Auth\Controller\Auth' => 'Auth\Controller\AuthController',
         ),
     ),
     
      // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'auth' => array(
                'type'    => 'segment',
                'options' => array(
                     'route'    => '/auth[/][:action][/:id]',
                     'constraints' => array(
                         'action'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'      => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Auth\Controller\Auth',
                         'action'     => 'auth',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'auth' => __DIR__ . '/../view',
         ),
     ),
 );


/*
 return array(
	'controllers' => array(
        'invokables' => array(
            'Auth\Controller\Index' => 'Auth\Controller\IndexController',		
        ),
	),
    'router' => array(
        'routes' => array(
			'auth' => array(
				'type'    => 'Literal',
				'options' => array(
					'route'    => '/auth',
					'defaults' => array(
						'__NAMESPACE__' => 'Auth\Controller',
						'controller'    => 'Index',
						'action'        => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '/[:controller[/:action[/:id]]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
								'id'     	 => '[a-zA-Z0-9_-]*',
							),
							'defaults' => array(
							),
						),
					),
				),
			),			
		),
	),
    'view_manager' => array(
//        'template_map' => array(
//            'layout/Auth'           => __DIR__ . '/../view/layout/Auth.phtml',
//        ),
        'template_path_stack' => array(
            'auth' => __DIR__ . '/../view'
        ),
		
		'display_exceptions' => true,
    ),
	'service_manager' => array(
		// added for Authentication and Authorization. Without this each time we have to create a new instance.
		// This code should be moved to a module to allow Doctrine to overwrite it
		'aliases' => array( // !!! aliases not alias
			'Zend\Authentication\AuthenticationService' => 'my_auth_service',
		),
		'invokables' => array(
			'my_auth_service' => 'Zend\Authentication\AuthenticationService',
		),
	),
); */