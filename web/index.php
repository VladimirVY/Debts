<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

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



$app->run();



