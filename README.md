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




**Migration**

Usage for create template migration file, it saves you time, creates an empty template, to create a table.
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

If you need create index in table use `class Indexes` need extends of his and set and override the $indexes property.
Where key in array it is a table name and value it's column example:
```
public $indexes = [
    'user' => ['email', 'status']
    ...
];
```
And delete function of the up, down. They are in Indexes class.
