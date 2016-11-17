<?php
function getFundraisingData() {
//
    $cacheFilePath = __DIR__ . '/cache/fundraising.json';

    if (file_exists($cacheFilePath)) {
        $fileModificationTime = filemtime($cacheFilePath);

        if (time() - $fileModificationTime < 3660) {
            return json_decode(file_get_contents($cacheFilePath), true);
        }
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://www.generosity.com/generosity/api/fundraisers/help-roman-and-his-family-to-beat-cancer.json'
    ));

    $result = curl_exec($curl);
    curl_close($curl);

    file_put_contents($cacheFilePath, $result);

    return json_decode($result, true);
}

class Request
{
    private static $data = [
        'lang' => 'en',
        'page' => 'about',
    ];

    public static function initialize()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        self::$data['page'] = pathinfo($path, PATHINFO_FILENAME) ?: 'about';
        $language = (($dirname = pathinfo($path, PATHINFO_DIRNAME)) == '/') ? '/en' : $dirname;

        self::$data['lang'] = current(explode('/', trim($language, '/')));
    }

    public static function getRequestUri()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public static function getLanguage()
    {
        return self::$data['lang'];
    }

    public static function getPage()
    {
        return self::$data['page'];
    }

    public static function checkETag($etag)
    {
        header('Content-Type: text/html; charset=utf-8');
        header("Etag: $etag");
        header("Cache-Control: public, max-age=120");

        if (trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
            header("HTTP/1.1 304 Not Modified");
            exit;
        }
    }
}
