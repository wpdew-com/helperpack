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
Register to app.php
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
enjoy