<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set('default_charset', 'UTF-8');

mb_internal_encoding('UTF-8');
setlocale (LC_ALL, 'ru_RU.UTF-8');
header('Content-type: text/html; charset=utf-8');


$pathStoragePublic     = __DIR__;
define('GIP_STORAGE_PUBLIC', $pathStoragePublic);

$pathMain       = dirname(dirname(__DIR__));
$pathStoragePrivate    = $pathMain;
define('GIP_STORAGE_PRIVATE', $pathStoragePrivate);

$pathComposer = join(DIRECTORY_SEPARATOR, [$pathStoragePrivate, 'vendor', 'autoload.php']);
require $pathComposer;

$partDefault = 'readme_how_use';
$partAvailable = [
    'readme_how_use'        => 'How to use from Readme.md',
    'all'                   => 'All',
    'declaration_create'    => 'Declaration create',
    'soap'                  => 'SOAP',
];
$partSelected = filter_input(INPUT_GET, 'part');

if (array_key_exists($partSelected, $partAvailable)) {
    $fileName = $partSelected;
} else {
    $fileName = $partDefault;
}


$pathMenu = join(DIRECTORY_SEPARATOR, [GIP_STORAGE_PRIVATE, 'tests', 'menu.php']);
require $pathMenu;

$pathPart = join(DIRECTORY_SEPARATOR, [GIP_STORAGE_PRIVATE, 'tests', 'part', $fileName.'.php']);
require $pathPart;
