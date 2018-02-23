<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'aliases'           => [
        '@public'       => Yii::$app->homeUrl . 'backend/web',
        '@bitbucket'    => 'https://bitbucket.org/blonder413/',
        '@delicious'    => 'https://delicious.com/blonder413',
        '@dribbble'     => 'https://dribbble.com/blonder413',
        '@facebook'     => 'https://www.facebook.com/blonder413',
        '@github'       => 'https://github.com/blonder413/',
        '@gitlab'       => 'https://gitlab.com/u/blonder413',
        '@google+'      => 'https://plus.google.com/u/0/+JonathanMoralesSalazar',
        '@lastfm'       => 'http://www.last.fm/es/user/blonder413',
        '@linkedin'     => 'https://www.linkedin.com/in/blonder413',
        '@twitter'      => 'https://twitter.com/blonder413',
        '@vimeo'        => 'https://vimeo.com/blonder413',
        '@youtube'      => 'https://www.youtube.com/channel/UCOBMvNSxe08V5E9qExfFt4Q',
    ],
    'id' => 'app-frontend',
    //'catchAll' => ['site/offline'],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'layout'  => 'blue/main',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'articulo/<slug>'           => 'site/article',
                'articulo/descarga/<slug>'  => 'site/download',
                'categoria/<slug>'          => 'site/category',
                'curso/index'               => 'site/all-courses',
                'curso/<slug>'              => 'site/course',
                'etiqueta/<tag>'            => 'site/tag',
                'acerca'                    => 'site/about',
                'home'                      => 'site/index',
                'contacto'                  => 'site/contact',
                'login'                     => 'site/login',
                "registro"                  => "site/signup",
                'pdf/<slug>'                => 'site/pdf',
                'portafolio'                => 'site/portfolio',
                'en-vivo'                   => 'site/streaming',

            ],
        ],
    ],
    'params' => $params,
];
