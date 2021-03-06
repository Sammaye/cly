<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

require_once(__DIR__ . '/../../vendor/yiisoft/yii2/helpers/ArrayHelper.php');
$commonConfig = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php')
);

return [
    'id' => 'comics-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'modules' => [],
    'components' => [
        'log' => [
            'targets' => [
                [
					'class' => 'common\components\ConsoleTarget',
					'levels' => ['error', 'warning', 'info', 'trace'],
					'categories' => ['application'],
					'displayDate' => true,
                ]
            ],
        ],
        'urlManager' => $commonConfig['components']['frontendUrlManager'],
    ],
    'params' => $params,
];
