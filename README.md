yii2-helpers
===================

A set of Yii2 helpers

Installation
------------
Run
```code
composer require "demi/helpers" "dev-master"
```

# Configuration
-------------
For enabling PHP 5.5 password hashing by Yii secure component:
In config file common/config/main.php:
```php
return [
    'components' => [
        'security' => [
            'passwordHashStrategy' => 'password_hash',
        ],
    ],
];
```

Usage
-----
gii model generator
```php
$config['modules']['gii'] = [
    'class'      => 'yii\gii\Module',
    'generators' => [
        'model'   => [
            'class'     => 'yii\gii\generators\model\Generator',
            'templates' => ['my_model' => '@demi/helpers/gii'],
        ]
    ]
];
```
big action grid column
```php
<?= GridView::widget([
    'columns' => [
        ['class' => 'demi\helpers\grid\BigActionColumn'],
    ],
]); ?>
```
