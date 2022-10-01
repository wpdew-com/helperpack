# HelperPack

use vendor autoload composer

## Installation and launch of the project. 

1. add repository to composer.json

```
"repositories": {
        "wpdew-com/ci4pack": {
            "type": "vcs",
            "url": "https://github.com/wpdew-com/helperpack.git"
        }
    },
```

2. add require section

```
"require": {
        ......
        "wpdew/helperpack": "dev-main"
    },
```
## Run install

```
composer update
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