<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'safelife',
    'language' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'America/New_York',
    'modules' => [
		'api' => [
			'class' => 'app\modules\api\Module',
		],
		'patient' => [
			'class' => 'app\modules\patient\Module',
		],
		'admin' => [
			'class' => 'app\modules\admin\Module',
		],
		'gridview' =>  [
			'class' => '\kartik\grid\Module'
			// enter optional module parameters below - only if you need to
			// use your own export download action or custom translation
			// message source
			// 'downloadAction' => 'gridview/export/download',
			// 'i18n' => []
		]
	],
    'components' => [
	    'formatter' => [
		    'class' => 'yii\i18n\Formatter',
		    'timeZone' => 'America/New_York',
		    'dateFormat' => 'php:Y-m-d',
			'datetimeFormat' => 'php:Y-m-d H:i:s',
		    'timeFormat' => 'php:H:i:s',
	    ],
	    'awsParams' => [
			'class' => 'app\components\awsParams'
		],
	    'guestSession' => [
		    'class' => 'app\components\GuestSession',
		    'sessionTable' => 'life_guest_session',
		    'sessionCookie' => 'gs',
	    ],
    	'stripe' => [
		    'class' => 'app\components\Stripe'
	    ],
    	'patient' => [
    		'class' => 'app\modules\patient\components\Patient'
	    ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
	        'class' => 'app\components\Request',
            'cookieValidationKey' => '4c9-Yg5nVK9wiAAzdVP5JAXDWg2qNM1G',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mail' => [
	        'class' => 'app\components\Mail'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
	            'class'      => 'Swift_SmtpTransport',
	            'host'       => getenv('SMTP_HOST'),
	            'username'   => getenv('SMTP_USER'),
	            'password'   => getenv('SMTP_PASSWORD'),
	            'port'       => getenv('SMTP_PORT'),
	            'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
	        'enableStrictParsing' => false,
	        'rules' => [
		        ['pattern'=>'about-us', 'route'=>'site/about'],
		        ['pattern'=>'faq',      'route'=>'site/faq'],
		        ['pattern'=>'logout',   'route'=>'site/logout'],
		        ['pattern'=>'login',    'route'=>'site/login'],
		        ['pattern'=>'terms-of-use',            'route'=>'site/page', 'defaults' => ['page'=>'terms-of-use'] ],
		        ['pattern'=>'privacy-policy',           'route'=>'site/page', 'defaults' => ['page'=>'privacy-policy'] ],
		        ['pattern'=>'soon-self-registered',     'route'=>'site/page', 'defaults' => ['page'=>'soon-self-registered'] ],
		        ['pattern'=>'register-account',         'route'=>'patient/default/activate', 'defaults' => ['register' => true]],
		        ['pattern'=>'activate-account',         'route'=>'patient/default/activate', 'defaults' => ['register' => false]],
		        ['pattern'=>'activate-complete-registration',    'route'=>'patient/default/activate-complete-registration'],
		        ['pattern'=>'subscriber-home',          'route'=>'patient/default/index'],
		        ['pattern'=>'subscriber-home/<action>', 'route'=>'patient/default/<action>'],
		        ['pattern'=>'register',                 'route'=>'patient/register/index'],
		        ['pattern'=>'forgot',                   'route'=>'patient/register/forgot'],
		        ['pattern'=>'register/<action>',        'route'=>'patient/register/<action>'],
		        ['pattern'=>'ajax/<action>',            'route'=>'ajax/<action>'],
		        ['pattern'=>'/patient/<hash>/<action>/<type>/<id>/<file_name>.<file_extension>', 'route'=>'patient/files/<action>'],
		        ['pattern'=>'scan/<token_slid_hash>',                                            'route'=>'patient/scan'],       // for scan of card, param is hash of slid#
		        ['pattern'=>'t', 'route'=>'site/t'],       // for scan of card, param is hash of slid#

		        '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>/<id>',
		        '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
		        '<module:\w+>/<action:\w+>/<id:\d+>' => '<module>/default/<action>/<id>',
		        '<module:\w+>/<action:[\wd-]+>' => '<module>/default/<action>',
		        '<module:\w+>' => '<module>/default/index',
	        ],
        ],
    ],
    'params' => $params,
    'on beforeRequest' => function () {
	    $app = Yii::$app;
	    $pathInfo = $app->request->pathInfo;
	    if (!empty($pathInfo) && substr($pathInfo, -1) == '/') {
		    $app->response->redirect('/' . trim($pathInfo, "/ \t\n\r\0\x0B"), 301);
		    $app->end();
	    }
    },
];
    
if (YII_DEBUG) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
//        'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.*'],
    ];
}

if (YII_GII) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.*'],
    ];
}

return $config;
