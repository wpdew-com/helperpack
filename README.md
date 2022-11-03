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

## How get GA4 only Laravel

1. publish --provider --tag="config"
2. set MEASUREMENT_ID and GOOGLE_APPLICATION_CREDENTIALS in config wpdew
3. use WpdewGa4

example request
```
$analitycs = new WpdewGa4;

     $getdata_user_week = [
        'start_date' => '7daysAgo', // 'YYYY-MM-DD', today, yesterday, 7daysAgo, 14daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, 1095daysAgo
        'end_date' => 'today', // 'YYYY-MM-DD', today, yesterday, 7daysAgo, 14daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, 1095daysAgo
        'metric' => 'activeUsers' // activeUsers, newUsers, sessions, totalUsers, screenPageViews
     ];
     $users_day_week = $analitycs->getMetriks($getdata_user_week);
```

## How get GA4 php 
1. Set env MEASUREMENT_ID
2. Set env GOOGLE_APPLICATION_CREDENTIALS path
3. Get data

example request
```
$analitycs = new WpdewGa4;
    $getdata_user_week = [
        'start_date' => '7daysAgo', //7daysAgo, 30daysAgo,
        'end_date' => 'today',
        'metric' => 'activeUsers' //screenPageViews
    ];
$users_week = $analitycs->phpgetMetriks($getdata_user_week);
```
<details>
 <summary>Option 1). Use HTTPS with a custom domain</summary>

1. Create a SSL cert:

```shell
cd cli
./create-cert.sh
```
<details>

enjoy