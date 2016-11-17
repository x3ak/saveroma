<?php
$lang = Request::getLanguage();

$twig = new Twig_Environment(new Twig_Loader_Filesystem([
    __DIR__ . '/layouts',
    __DIR__ . '/layouts/'. $lang,
    __DIR__ . '/pages/'. $lang
]), [
//    'cache' => __DIR__ . '/cache/twig/' . $lang,
]);


$twig->addGlobal('lang', $lang);
$twig->addGlobal('currentPage', Request::getPage());

