<?php

$rootDir = __DIR__ . '/../..';

$params = array_merge(
		require($rootDir . '/common/config/params.php'), require($rootDir . '/common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
	'id' => 'app-frontend',
	'basePath' => dirname(__DIR__),
	'vendorPath' => $rootDir . '/vendor',
	'controllerNamespace' => 'frontend\controllers',
	'extensions' => require($rootDir . '/vendor/yiisoft/extensions.php'),
	'modules' => [
		'auth' => [
			'class' => 'auth\Module',
			'attemptsBeforeCaptcha' => 3, // Optional
			'superAdmins' => ['admin'], // Recommended
			'tableMap' => [ // Optional, but if defined, all must be declared
				'User' => 'user',
				'UserStatus' => 'user_status',
				'ProfileFieldValue' => 'profile_field_value',
				'ProfileField' => 'profile_field',
				'ProfileFieldType' => 'profile_field_type',
			],
		],
	],
	'components' => [
		'db' => $params['components.db'],
		'cache' => $params['components.cache'],
		'mail' => $params['components.mail'],
		'user' => [
//			'identityClass' => 'auth\models\User',
			'class' => 'auth\models\User',
//			'table' => 'user',
			'enableAutoLogin' => true,
		],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
			'db' => 'db',
			'assignmentTable' => 'AuthAssignment',
			'itemChildTable' => 'AuthItemChild',
			'itemTable' => 'AuthItem',
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
	],
	'params' => $params,
];
