<?php
use Silexpack\Service\Service;

$service = new Service($app['db']);

$pages = $app['db']->fetchAll("SELECT * FROM pages");

$app->get('/header', function () use ($app, $pages) {
	return $app['twig']->render('header.twig', [
		'pages'=>$pages,
	]);
})->bind('header');

foreach ($pages as $page) {
	$app->get($page['pattern'], function () use ($app, $service, $page) {
		return $app['twig']->render($page['pageName'] . '.twig', [
			'title' => $page['title'],
			'description' => $page['description'],
			'keywords' => $page['keywords'],
		]);
	})
		->bind($page['routeName']);
}