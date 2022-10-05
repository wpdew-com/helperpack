<?php

$classMap = [
    'Wpdew\\HelperPack\\HelperPack' => 'WpdewHelp'
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
}