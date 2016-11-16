<?php
use Silexpack\Service\Service;

$service = new Service($app['db']);

$app->get('/', function () use ($app, $service) {
	var_dump($service->selectAll('band'));
    return $app['twig']->render('index.twig', [
        'message'=>$service->test(),
    ]);
    })
    ->bind('home');