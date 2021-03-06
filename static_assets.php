<?php
$staticMatches = [];
if (preg_match('/^\/static\/(.*)\.(.{32}).(.*)/', Request::getRequestUri(), $staticMatches)) {

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
