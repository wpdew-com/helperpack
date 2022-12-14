<?php

$classMap = [
    'Wpdew\\HelperPack\\HelperPack' => 'WpdewHelp',
    'Wpdew\\HelperPack\\Gamp' => 'WpdewGamp',
    'Wpdew\\HelperPack\\Ga4' => 'WpdewGa4',
];

foreach ($classMap as $class => $alias) {
    class_alias($class, $alias);
}

/**
 * This class needs to be defined explicitly as scripts must be recognized by
 * the autoloader.
 */


if (\false) {
    class WpdewHelp extends \Wpdew\HelperPack\HelperPack
    {
    }
    class WpdewGamp extends \Wpdew\HelperPack\Gamp
    {
    }
    class WpdewGa4 extends \Wpdew\HelperPack\Ga4
    {
    }
}