<?php

require_once __DIR__.'/../vendor/autoload.php'; // 

$app = new Silex\Application();
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

use Silex\Provider\FormServiceProvider;
$app->register(new FormServiceProvider());


$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
		'db.options' => array(
			'driver' => 'pdo_mysql',
			'host' => 'localhsost',
			'dbname' => 'mobile_app',
			'user' => 'root',
			'password' => '',
			'charset' => 'utf8',
		)
	)
);


$app->match('/form', function (Request $request) use ($app) {
    // some default data for when the form is displayed the first time
    $data = array(
        
    );
	$users = $app['db']->featchAll('SELECT name, surname, id FROM users');
	$vk_users = [];
	foreach ($users as $kay =>  ) {
		$vk_users['id'] = $user['name'].' '.$user['surname'];
	}
    $form = $app['form.factory']->createBuilder('form', $data)
        ->add('amount_initial')
        ->add('comment')
        ->add('name', 'choice', array(
			
            'choices' => $vk_users,
            'expanded' => true,
        ))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        // do something with the data

        // redirect somewhere
        return $app->redirect('...');
    }

    // display the form
    return $app['twig']->render('new_twig.twig', array('form' => $form->createView()));
});

$app->get('/hello/{name}', function ($name) use ($app) {
    return $app['twig']->render('hello.twig', array(
        'name' => $name,
    ));
});

$app->get('/dashboard/new_debt', function() use($app){ 
    
	
	$app['db']->insert('friends', array('name'=> $name, 'surname' => $surname, 'vk_id' => $vk_id));
	
});


$app->run(); //
