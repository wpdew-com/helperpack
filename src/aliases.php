<?php

$classMap = [
    'Wpdew\\HelperPack\\HelperPack' => 'WpdewHelp'
];

foreach ($classMap as $class => $alias) {
    class_alias($class, $alias);
}