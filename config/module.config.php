<?php
namespace Sitemap;

return array(
	'sitemapable'=>array(
		'modules'=>array(
			array(
				'name'=>'DynamicPages\Entity\DynamicPage',
                'slug_field'=>'uri',         
                'description'=>'body',
				'route'=>'cms-page'
			),
			array(
				'name'=>'Blog\Entity\Post',
                'slug_field'=>'slug',
                'description'=>'excerpt',
                'route'=>'news/view'
			),
			array(
				'name'=>'Events\Entity\Event',
                'slug_field'=>'slug',
                'description'=>'body',
                'route'=>'news/view'
			),
		),
	),
    'bjyauthorize' => array(
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'Sitemap\Controller\Admin' => array(),
            ),
        ),
        'rule_providers'     => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    // VIEW ITEMS
                    array(array('editor'), 'Sitemap\Controller\Admin', array('add', 'list')),
                )
            )
        ),
        'guards' => array(
            'BjyAuthorize\Guard\Controller' => array(
                array(
                    'controller' => 'Sitemap\Controller\Sitemap',
                    'action'=>array('index'),
                    'roles' => array('guest')
                ),

                array(
                    'controller' => 'Sitemap\Controller\Admin',
                    'roles' => array('editor'),
                    'action'=>array('index', 'edit', 'rebuild'),
                ),

                array(
                    'controller' => 'Sitemap\Controller\Admin',
                    'roles' => array('publisher'),
                ),
            ),
            'BjyAuthorize\Guard\Route' => array(

                array('route' => 'zfcadmin/sitemap', 'roles' => array('editor')),
                array('route' => 'zfcadmin/sitemap/rebuild', 'roles' => array('editor')),

                array('route' => 'sitemap', 'roles' => array('guest')),

            ),
        ),
    ),


    'navigation' => array(
        'admin' => array(
            // 'Sitemap'=>array(
            //     'icon'=>'entypo-tree',
            //     'label' => 'Sitemap Results',
                // 'resource' => 'Sitemap\Controller\Admin',
            //     'privilege'=>'list',
            //     'order'=>10,
            //     'route' => 'zfcadmin/sitemap',
            // ),
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'zfcadmin' => array(
                'child_routes' => array(
                    'sitemap' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/sitemap',
                            'defaults' => array(
                                'controller' => 'Sitemap\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'rebuild' => array(
                                'type'    => 'Literal',
                                'options' => array(
                                    'route'    => '/rebuild',
                                    'defaults' => array(
                                        'controller' => 'Sitemap\Controller\Admin',
                                        'action'     => 'rebuild',
                                    ),
                                ),
                            )
                        ),
		                'child_routes' => array(
		                    'renderxml' => array(
		                        'type'    => 'Literal',
		                        'options' => array(
		                            'route'    => '/renderxml',
		                            'defaults' => array(
		                                'controller' => 'Sitemap\Controller\Admin',
		                                'action'     => 'renderxml',
		                            ),
		                        ),
		                    )
		                )
                    ),
                ),
            ),
            'sitemap' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/sitemap',
                    'defaults' => array(
                        'controller' => 'Sitemap\Controller\Sitemap',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'sitemap' => __DIR__ . '/../view',
        ),
    ),

    'controllers'=>array(
        'invokables'=>array(
            'Sitemap\Controller\Sitemap'=>'Sitemap\Controller\SitemapController',
            'Sitemap\Controller\Admin' => 'Sitemap\Controller\AdminController'
        )
    ),

	'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            ),
        ),
        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array(
                    'Gedmo\Timestampable\TimestampableListener',
                 ),
            ),
        ),
    ),
);