<?php

$finder = \Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('bin')
    ->exclude('cache')
    ->exclude('doc')
    ->exclude('logs')
    ->exclude('vendor')
    ->in(__DIR__)
;

return \Symfony\CS\Config\Config::create()
    ->fixers(array('-visibility', '-multiple_use'))
    ->setUsingCache(true)
    ->finder($finder)
;
