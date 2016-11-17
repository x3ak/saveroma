<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require_once __DIR__ . '/initialize_twig.php';

// add support for static assets, it will intercept requests too!
require_once __DIR__ . '/static_assets.php';

try {
    $page = Request::getPage();

    $parameters = [];
    if ($page == 'fundraising.html') {
        $parameters = getFundraisingData();
    }

    $content = $twig->render($page . '.twig', $parameters);
    Request::checkETag(md5($content));

    echo $content;

} catch (\Twig_Error_Loader $e) {
//    header("HTTP/1.0 404 Not Found");
//    exit;
}

