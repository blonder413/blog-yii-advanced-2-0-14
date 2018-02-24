<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager'       => [
            'class'         => 'yii\rbac\DbManager',
            'defaultRoles'  => ['guest'],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /**
         * http://www.yiiframework.com/doc-2.0/guide-runtime-sessions-cookies.html
         * The default yii\web\Session class stores session data as files on the server.
         * Yii also provides the following session classes implementing different session storage:
         *  - yii\web\DbSession: stores session data in a database table.
         *  - yii\web\CacheSession: stores session data in a cache with the help of a configured cache component.
         *  - yii\redis\Session: stores session data using redis as the storage medium.
         *  - yii\mongodb\Session: stores session data in a MongoDB.
         */
        'session' => [
            'class' => 'yii\web\DbSession',
            // 'timeout' => 10, segundos de inactividad para expirar la sesión

            // Set the following if you want to use DB component other than
            // default 'db'.
            // 'db' => 'mydb',

            // To override default session table, set the following
            'sessionTable' => 'sessions',
        ],
    ],
];
