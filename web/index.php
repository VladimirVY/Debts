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
			'host' => 'localhost',
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
	foreach ($users as $user) {
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

$app->register(new Silex\Provider\TwigServiceProvider(), 
                array('twig.path' => __DIR__.'/../views',
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());




use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->get('/hello', function (Request $request) use ($app) {
    $code = $request->get('code');

$str=file_get_contents('https://oauth.vk.com/access_token?client_id=3977669&client_secret=06aTUBK00Ee072ODRiip&code='.$code.'&redirect_uri=http://localhost'.$app['url_generator']->generate('homepage'));

$str1=json_decode($str,true);
$mass=file_get_contents('https://api.vk.com/method/friends.get?'.$str1['user_id'].'&access_token='.$str1['access_token']);
var_dump($mass);
    return 'Hello!';
})
->bind('homepage');



$app->get('/', function() use ($app) {
    return $app['twig']->render('main.html',array());
}); 


$app->get('/dashboard/new_debt', function() use($app){ 
    
	
	$app['db']->insert('friends', array('name'=> $name, 'surname' => $surname, 'vk_id' => $vk_id));
	
});

$app->get('/notifycheck', function() use($app){

    $sql = "SELECT * FROM debts WHERE status = 1";
    $depts = $app['db'] -> fetchAll ($sql);
    foreach ($depts as $dept) {
        if (strtotime($dept['last_notify']) < time()) {

        }
    }


});
$app->run();
