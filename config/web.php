<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'language' => 'es',
    'components' => [

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views',
                ],
            ],
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '0KLb6suHNA0H4guA1fmVckHbB_wVlWHB',
            //Para habilitar JSON dentro del servicio WEB
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Persona',
            'enableAutoLogin' => false,
            'enableSession' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
                      'viewPath' => '@app/mail',
                       'useFileTransport' => true,
                    'transport' => [
             'class' => 'Swift_SmtpTransport',
             'host' => 'smtp.gmail.com',  // ej. smtp.mandrillapp.com o smtp.gmail.com
             'username' => 'sistemadiscvisual@gmail.com',
             'password' => 'camiloqwerty99',
             'port' => '587', // El puerto 25 es un puerto común también
             'encryption' => 'ssl',
         ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.*/
            //'useFileTransport' => true,
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
        'db' => $db,
        
        'response' => [
            
            'formatters' => [
              \yii\web\Response::FORMAT_JSON => [
             'class' => 'yii\web\JsonResponseFormatter',
             'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
             
        ],
    ],
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class'=>'yii\rest\UrlRule','controller'=>'service',],
                ['class'=>'yii\rest\UrlRule','controller'=>'service-campana',],
                ['class'=>'yii\rest\UrlRule','pluralize' => 'false','controller'=>'service-comuna',],
                ['class'=>'yii\rest\UrlRule','pluralize' => 'false','controller'=>'service-region',],
                ['class'=>'yii\rest\UrlRule','pluralize'=>false,'controller'=>'service-interactuar-campana'],
                 ['class'=>'yii\rest\UrlRule','pluralize'=>false,'controller'=>'service-interactuar-tramite'],
                'services/service-comuna/get-comuna/<region_id_region:\d+>' => 'services/service-comuna/get-comuna',
                'services/service-comuna/listar-comunas' => 'services/service-comuna/listar-comunas',
                'services/service-region/get-region/<id:\d+>' => 'services/service-region/get-region',
                'services/service-campana/listar-campanas' => 'services/service-campana/listar-campanas',
                'services/service-tramite/listar-tramites' => 'services/service-tramite/listar-tramites',
                'services/service-interactuar-campana/registrar-interaccion-campana/<auth_key:[^/]+>' => 'services/service-interactuar-campana/registrar-interaccion-campana',
                'services/service-interactuar-tramite/registrar-interaccion-tramite/<auth_key:[^/]+>' => 'services/service-interactuar-tramite/registrar-interaccion-tramite',
               '<controller:\w+>/<action:\w+>/<user:[^/]+>/<password:\w+>' => '<controller>/<action>',
            ],
        ],
        

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'es',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
    ],




    'modules' => [
        /* other modules */
        'markdown' => [
            'class' => 'kartik\markdown\Module',
        ],

        'dynagrid'=> [
            'class'=>'\kartik\dynagrid\Module',
            // other module settings
        ],
        'gridview'=> [
            'class'=>'\kartik\grid\Module',
            // other module settings
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
