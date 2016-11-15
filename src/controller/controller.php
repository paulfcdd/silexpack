<?php

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig', [
        'message'=>'Hello world',
    ]);
    })
    ->bind('home');