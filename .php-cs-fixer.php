<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__)        // Prohledávat bude celou složku projektu
    ->exclude('vendor'); // Vynechá složku vendor (knihovny)

return (new Config())
    ->setRules([
        '@PSR12' => true,               // Standard PSR-12
        'array_syntax' => ['syntax' => 'short'],   // Používat krátké pole []
        'binary_operator_spaces' => ['default' => 'align'], // Zarovnat operátory
        'no_unused_imports' => true,   // Odstranit nepoužívané importy
    ])
    ->setFinder($finder);
