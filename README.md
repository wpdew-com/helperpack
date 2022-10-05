# HelperPack

use vendor autoload composer

## Installation and launch of the project. 

1. add require section 

```
"require": {
        ......
        "wpdew/helperpack": "dev-main"
    },
```
2. or run composer command
```
composer require wpdew/helperpack
```
3. configure package version if you need in composer.json
example
```
dev 
"wpdew/helperpack": "dev-main"
or stabl
"wpdew/helperpack": "^1.0"
```

## Run install

```
composer update
```

## Add to laravel 
Register to app.php manual
```
Wpdew\HelperPack\LaravelWpdewServiceProvider::class,
```
Run vendor publish
```
php artisan vendor:publish --provider="Wpdew\HelperPack\LaravelWpdewServiceProvider" --tag="config"
```

## How to use

1. Add use to controller

```
use Wpdew\HelperPack;
```

2. run class

```
$helperpack = new HelperPack\HelperPack();
$name = $helperpack->getName("Aleks");

$laravel = new HelperPack\HelperLaravel();
$laraname = $laravel->getName("Aleks");
```

## How get GAMP only Laravel

1. publish --provider --tag="config"
2. set key path and ga_id in config wpdew
3. use WpdewGamp

example request
```
$gamp = new WpdewGamp(); 
$analytics = $gamp->initializeAnalytics();

    $data_user = [
        "setStartDate" => "7daysAgo", 
        "setEndDate" => "today", 
        "setExpression" => "ga:users", 
        "setAlias" => "setAlias",
    ];
    $response_user = $gamp->getReport($analytics , $data_user);
    $resuse_week = $gamp->printResults($response_user);
```



enjoy