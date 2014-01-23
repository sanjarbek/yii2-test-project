<?php

$rootDir = __DIR__ . '/../..';

$params = array_merge(
		require($rootDir . '/common/config/params.php'), require($rootDir . '/common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
	'id' => 'app-console',
	'basePath' => dirname(__DIR__),
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'controllerNamespace' => 'console\controllers',
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
	'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
	'components' => [
		'db' => $params['components.db'],
		'cache' => $params['components.cache'],
		'mail' => $params['components.mail'],
		'log' => [
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
			'db' => 'db',
			'assignmentTable' => 'AuthAssignment',
			'itemChildTable' => 'AuthItemChild',
			'itemTable' => 'AuthItem',
		],
	],
	'params' => $params,
];
