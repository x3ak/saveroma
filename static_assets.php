<?php
$twig->addFilter(new Twig_SimpleFilter('add_hash', function ($file){

    $filePath = __DIR__ . '/static/' . $file;


    if (!file_exists($filePath)) {
        return $file;
    }

    $hash = md5_file($filePath);

    return '/static/' . preg_replace('/(.*)\.(.*)/', sprintf("$1.%s.$2", $hash), $file);
}));

$staticMatches = [];
if (preg_match('/^static\/(.*)\.(.{32}).(.*)/', Request::getRequestUri(), $staticMatches)) {

    $assetName = $staticMatches[1] . '.' . $staticMatches[3];

    $filePath = __DIR__ . '/static/' . $assetName;

    if (!file_exists($filePath)) {
        die('Not found');
    }

    switch ($staticMatches[3]) {
        case 'js':
            $contentType = 'text/javascript';
            break;
        case 'css':
            $contentType = 'text/css';
            break;
        case 'json':
            $contentType = 'application/json';
            break;
        default:
            $contentType = 'text/text';
    }

    header('Content-Type: ' .$contentType);
    header("Cache-Control: public, max-age=31536000");
    header("Etag: " . md5_file($filePath));

    require_once $filePath;

    exit;
}
