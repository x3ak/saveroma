<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

try {
    Request::initialize();

    // add support for static assets, it will intercept requests too!
    require_once __DIR__ . '/static_assets.php';

    require_once __DIR__ . '/initialize_twig.php';

    $page = Request::getPage();

    $parameters = [];
    if ($page == 'fundraising') {
        $parameters = getFundraisingData();
    }

    if ($page == 'bank') {

    }

    $content = $twig->render($page . '.html.twig', $parameters);
    Request::checkETag(md5($content));

    echo $content;

} catch (\Twig_Error_Loader $e) {
    var_dump($e);
//    header("HTTP/1.0 404 Not Found");
//    exit;
}

