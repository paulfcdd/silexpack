<?php
use Silexpack\Service\Service;

$service = new Service($app['db']);

$app->post('/test_action', function ()use ($app, $service){

})->bind('test_action');