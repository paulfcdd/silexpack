<?php
use Silex\Application;
use Rpodwika\Silex\YamlConfigServiceProvider;
use Silex\Provider\{
    DoctrineServiceProvider, AssetServiceProvider, SessionServiceProvider, MonologServiceProvider, TwigServiceProvider, HttpFragmentServiceProvider,
    WebProfilerServiceProvider, ServiceControllerServiceProvider
};

$app = new Application();
$app
    ->register(new YamlConfigServiceProvider(__DIR__ . '/../config/config.yml'))
    ->register(new DoctrineServiceProvider(), [
        'db.options' => [
            'driver' => $app['config']['config']['driver'],
            'host' => $app['config']['config']['host'],
            'user' => $app['config']['config']['db_user'],
            'dbname' => $app['config']['config']['db_name'],
            'password' => $app['config']['config']['db_password'],
            'charset' => 'utf8mb4',
        ],
    ])
    ->register(new AssetServiceProvider(), [
        'assets.version_format' => '%s?version=%s',
        'assets.named_packages' => array(
            'css' => [
                'base_path' => __DIR__ . '/../web/css',
            ],
            'images' => [
                'base_path' => __DIR__ . '/../web/img',
            ],
            'js' => [
                'base_path' => __DIR__ . '/../web/js',
            ],
        ),
    ])
    ->register(new MonologServiceProvider(), [
        'monolog.logfile' => __DIR__ . '/../logs/syslog-' . date('d-m-Y') . '.log'
    ])
    ->register(new HttpFragmentServiceProvider())
    ->register(new SessionServiceProvider())
    ->register(new TwigServiceProvider(), [
        'twig.path' => __DIR__ . '/../tpl',
    ])
    ->register(new WebProfilerServiceProvider(), [
        'profiler.cache_dir' => __DIR__.'/../cache/profiler',
        'profiler.mount_prefix' => '/_profiler',
    ])
    ->register(new ServiceControllerServiceProvider());

return $app;