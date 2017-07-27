My personal helper.
===================
This is the package of classes that I use from project to project.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist gud3/yii2-helper "*"
```

or add

```
"gud3/yii2-helper": "*"
```

to the require section of your `composer.json` file.




Usage for create template migration file
```
return [
    'components' => [
        ...
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'templateFile' => '@vendor/gud3/yii2-heplers/migrations/templates/base.php'
        ],
    ],
    ...
];
```