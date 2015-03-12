yii2-helpers
===================

A set of Yii2 helpers

Installation
------------
Add to composer.json in your project
```json
{
	"require":
	{
  		"demi/helpers": "dev-master"
	}
}
```
then run command
```code
php composer.phar update
```

Configuration
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