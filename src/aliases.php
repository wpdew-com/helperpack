<?php

$classMap = [
    'Wpdew\\HelperPack' => 'WpdewHelp'
];

foreach ($classMap as $class => $alias) {
    class_alias($class, $alias);
}