<?php
$lang = Request::getLanguage();

$twig = new Twig_Environment(new Twig_Loader_Filesystem([
    __DIR__ . '/layouts',
    __DIR__ . '/layouts/'. $lang,
    __DIR__ . '/pages/'. $lang,
    __DIR__ . '/pages/all',
]), [
//    'cache' => __DIR__ . '/cache/twig/' . $lang,
]);


$twig->addGlobal('lang', $lang);
$twig->addGlobal('currentPage', Request::getPage());

$twig->addGlobal('banks', json_decode(file_get_contents(__DIR__ . '/pages/banks-data.json'), true));

$twig->addFilter(new Twig_SimpleFilter('add_hash', function ($file){

    $filePath = __DIR__ . '/static/' . $file;


    if (!file_exists($filePath)) {
        return $file;
    }

    $hash = md5_file($filePath);

    return '/static/' . preg_replace('/(.*)\.(.*)/', sprintf("$1.%s.$2", $hash), $file);
}));
